
           $(document).ready(function() {
            //('id')/('price')==data-price main
            showTable();

            function showTable(){
                var mycart=localStorage.getItem('mycart');
                if(mycart){
                    var mycartobj=JSON.parse(mycart);
                    console.log(mycartobj.cart)
                    var html='';var j=1; total=0;
                    $.each(mycartobj.cart,function (i,v) {
                        // body...check/.cart
                        if(v){
                            var id=v.id;
                            var name=v.name;
                            var perprice=v.perprice;
                            var quantity=v.quantity;
                            var photo=v.photo;
                            var subtotal=quantity*perprice;
                            total +=parseInt(subtotal);
                            html+='<tr><td>'+j+'</td><td><img src="'+photo+'" width="50" height="50" border="1"></td><td>'
                            +name+'</td><td>'+quantity+'</td><td>'+perprice+'</td><td><button class="btn btn-danger delete" data-id='+i+'>Delete</button></td></tr>';
                            j++;
                        }
                    })
                    html+='<tr><td colspan="5" style="text-align:center;">Total</td><td id=total>'+total+'</td></tr>';
                    $("tbody").html(html);
                }
            }
        
            $(".addToCart").click(function(){

            var id=$(this).data('id');
            var photo=$(this).data('photo');
            var name=$(this).data('name');
            var perprice=$(this).data('price');
            console.log(id+photo+name+perprice);
            var novel={
                id:id,
                photo:photo,
                name:name,
                quantity:1,
                perprice:perprice
           }
           var mycart=localStorage.getItem('mycart');
            if(!mycart){
                mycart='{"cart":[]}';
            }
                var mycartobj=JSON.parse(mycart);
                var hasid=false;
                var index='';
                $.each(mycartobj.cart,function (i,v) {
                    // body...id remember you .cart
                    if(v){
                        if(id==v.id){
                            hasid=true;
                            index=i;
                        }
                    }
                })
                if(!hasid){
                    mycartobj.cart.push(novel);//
                }else{
                    mycartobj.cart[index].quantity++;//
                }
                localStorage.setItem('mycart',JSON.stringify(mycartobj));
                console.log(mycartobj);
            })
           
            /*$("tbody").on('click','.delete',function () {
                // body...
                var id=$(this).data('id');
                var ans=confirm('Are you sure?');
                if(ans){
                    var mycart=localStorage.getItem('mycart');
                    var mycartobj=JSON.parse(mycart);
                    mycartobj.cart[id]=null;
                    localStorage.setItem('mycart',JSON.stringify(mycartobj));
                    showTable();
                }

            })*/
 
    
        /*$(.tbody).on('click',function()*/
        $('.order').on('click',function(){

            var total = $('#total').html();
            var order = confirm('Are you sure to order? Your Total Amount is '+ total);
            if (order==true) {
                var mystoreditem = localStorage.getItem('mycart');
                if (mystoreditem) {
                    var mystoreditem = JSON.parse(mystoreditem);
                    var cart = mystoreditem.cart;
                    var mycartstring = JSON.stringify(cart);
                    $.ajax({
                        method: 'post',
                        url: 'order.php',
                        data: {cart:mycartstring},
                        success:function(response){
                            alert(response);
                            if (response == 'success') {
                                localStorage.clear();
                                alert('Your Order Successfully completely');
                                showTable();
                            }
                        }
                    })
                }
            }
        })

});
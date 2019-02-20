$(document).ready(function() {
	/* cek cart */
	if (!MEMBER) {
		var cek = localStorage.getItem('cart');
		if (cek != null) {
			var cart = JSON.parse(cek);
			if (cart.length > 0) {
				$('.badge-cart').removeClass('hide').html(cart.length);
				$('.badge-cart-mobile').removeClass('hide').html(cart.length);
			}
		}
	}

    $('.tab-btn-container a').click(function(a) {
        var tab = $(this).attr('id');
        $('.tab-btn-container a').css({
            'background-color': '#ededed'
        })
        $(this).css({
            'background-color': '#f8f8f8'
        })

        $('.tab-content > div').css('display', 'none');
        $('#' + $(this).attr('id') + '-content').css('display', 'block');
    });

    $('.pro p').click(function() {
        $(this).css({
            'color': '#FFF',
            'background-color': '#2ecc71',
            'border': 'none'
        })
        $('.premium p').css({
            'color': '#339bd5',
            'background-color': 'transparent',
            'border': '2px solid #339bd5'
        })
        $('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'transparent');
        $('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'rgba(46, 204, 113,.1)');
    });

    $('.premium p').click(function() {
        $(this).css({
            'color': '#FFF',
            'background-color': '#2ecc71',
            'border': 'none'
        })
        $('.pro p').css({
            'color': '#339bd5',
            'background-color': 'transparent',
            'border': '2px solid #339bd5'
        })
        $('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'transparent');
        $('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'rgba(46, 204, 113,.1)');
    });
});

function addToCart(id) {
    var datapost = {
        '_token': TOKEN,
        'id': id
    };
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/cart/add',
        data: datapost,
        success: function(data) {
            if (typeof data !== 'null') {
                if (!MEMBER) {
                    var cek = localStorage.getItem('cart');
                    if (cek == null) {
                        var cart = [];
                        cart.push({
                            'id': data.id,
                            'image': data.image,
                            'title': data.title,
                            'price': data.price,
                        });
                    } else {
                        var exist = false;
                        var cart = JSON.parse(cek);
                        
                        $.each(cart, function(k, v) {
                            if (v.id == data.id) {
                                exist = true;
                            }
                        })
                        if (!exist) {
                            cart.push({
                                'id': data.id,
                                'image': data.image,
                                'title': data.title,
                                'price': data.price,
                            });
                        }
                    }

                    localStorage.setItem('cart', JSON.stringify(cart));
                }

                swal({
                    title: "Menambahkan ke keranjang",
                    text: data.title,
                    type: "success",
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: 'Tutorial lainnya',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: "Lihat keranjang"
                }).then(function(isConfirm) {
                    if (isConfirm.value) {
                        window.location.href = SITE_URL + '/cart';
                    } else if (swal.cancelButton) {
                        window.location.href = SITE_URL + '/lessons/browse/all';
                    } else {
                        window.location.href = SITE_URL + '/lessons/browse/all';

                    }
                });
            } else {
                alert('Koneksi Bermasalah, Silahkan Ulangi');
                location.reload();
            }
        }
    })
}

function addToCartBootcamp(id) {
    var datapost = {
        '_token': TOKEN,
        'id': id
    };
    $.ajax({
        type: 'POST',
        url: SITE_URL + '/cart/add/bootcamp',
        data: datapost,
        success: function(data) {
            if (typeof data !== 'null') {
                if (!MEMBER) {
                    var cek = localStorage.getItem('cart');
                    if (cek == null) {
                        var cart = [];
                        cart.push({
                            'id': data.id,
                            'image': data.image,
                            'title': data.title,
                            'price': data.price,
                        });
                    } else {
                        var exist = false;
                        var cart = JSON.parse(cek);
                        
                        $.each(cart, function(k, v) {
                            if (v.id == data.id) {
                                exist = true;
                            }
                        })
                        if (!exist) {
                            cart.push({
                                'id': data.id,
                                'image': data.image,
                                'title': data.title,
                                'price': data.price,
                            });
                        }
                    }

                    localStorage.setItem('cart', JSON.stringify(cart));
                }

                swal({
                    title: "Menambahkan ke keranjang",
                    text: data.title,
                    type: "success",
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: 'Tutorial lainnya',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: "Lihat keranjang"
                }).then(function(isConfirm) {
                    if (isConfirm.value) {
                        window.location.href = SITE_URL + '/cart';
                    } else if (swal.cancelButton) {
                        window.location.href = SITE_URL + '/lessons/browse/all';
                    } else {
                        window.location.href = SITE_URL + '/lessons/browse/all';

                    }
                });
            } else {
                alert('Koneksi Bermasalah, Silahkan Ulangi');
                location.reload();
            }
        }
    })
}

function deleteCart(id) {
    var carts = JSON.parse(localStorage.getItem('cart'));
    if (carts) {
        $.each(carts, function(k, v) {
            if (id == v.id) {
                carts.splice(k, 1);
                localStorage.setItem('cart', JSON.stringify(carts));
                // $('#cart-'+id).remove();
                // localStorage.removeItem('cart');
                window.location.href = SITE_URL + '/cart';
            }
        });
    }
}

function formatMoney(c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
//custom file input
;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});

		// Firefox bug fix
		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});
}( document, window, 0 ));

$(function() {

	var ajaxurl = window.wp_data.ajaxurl;
	var search_icon = ".top-menu1__search-icon";
	var search_input = ".top-menu1__search .ctr_search input";
	var search_submit = ".top-menu1__search .fr_search_widget";
	var search_container = ".top-menu1__search .pp_search_container"
	var menu1_nav = ".head-menu";
	var search_text = $(search_input).attr('placeholder');

	var hamburger = "#menu-toggle";
	var menu1 = ".top-menu1";
	var menu2 = ".top-menu2";
	var logged_menu = ".logged-menu";

	var top_head = ".top-head";
	var menu1_box = ".top-menu1__box";
	var clr_menu1_box = $(menu1_box).css('border-color');

//	Форма поиска в шапке
$(search_icon).on('click', function() {

	//	Mobile
	if( $(window).width() < 600 ){
		if( $(search_input).val() == "" || $(search_input).val() == search_text) 
		{
			$(search_input).focus();
		}
		else {
			$(search_submit).submit();
		}
		return false;
	}

	$(menu1_box).css('border-color', '#dd1f26');

	if( $(search_container).css("visibility") == "hidden"){
		$(menu1_nav).css("visibility", "hidden");
		$(search_container).css("visibility", "visible");
		$(search_input).focus();
	}
	else {
		if( $(search_input).val() == "" || $(search_input).val() == search_text) 
		{
			$(menu1_nav).css("visibility", "visible");
			$(search_container).css("visibility", "hidden");
			$(menu1_box).css('border-color', clr_menu1_box);
		}
		else{
			$(search_submit).submit();
		}
	}
	return false;
});

//	Иконки соц.сетей
$(".ats__sn a").html('');
$(".ats__sn a[href*='vk.com']").addClass('fab fa-vk');
$(".ats__sn a[href*='twitter.com']").addClass('fab fa-twitter');
$(".ats__sn a[href*='instagram.com']").addClass('fab fa-instagram');
$(".ats__sn a[href*='facebook.com']").addClass('fab fa-facebook');
$(".ats__sn a[href*='fb.com']").addClass('fab fa-facebook');
$(".ats__sn a[href*='plus.google']").addClass('fab fa-google-plus');
$(".ats__sn a[href*='youtube.com']").addClass('fab fa-youtube');
$(".ats__sn a[href*='ok.ru']").addClass('fab fa-odnoklassniki');
$(".ats__sn a[href*='odnoklassniki.ru']").addClass('fab fa-odnoklassniki');
$(".ats__sn a[href*='t.me']").addClass('fab fa-telegram');

//	Гамбургер
$(hamburger).on('click', function() {
	if( $(menu1).css("display") == "none" )
	{
		$(menu1).css("display", "block");
		$(search_container).css("visibility", "visible");
		$(menu2).css("display", "block");
		$(logged_menu).css("display", "block");
	}
	else
	{
		$(menu1).css("display", "none");
		$(search_container).css("visibility", "hidden");
		$(menu2).css("display", "none");
		$(logged_menu).css("display", "none");
	}
});


//	Растягиваем поиск на ширину меню/окна
function windowSize(){
	if( $(window).width() > 600 ){ $(search_container).css("width", $(menu1_box).width() - 10 ); }
	else { $(search_container).css("width", $(top_head).width() - 50 ); }

	//	Mobile выпадающее меню
	if( $(window).width() < 600 ){
		$('.head-menu-c .menu-btn').on('click', function() {
			if( $(this).siblings('.sub-menu').css('display') == 'none' ) {
				$(this).siblings('.sub-menu').css('display', 'block');
				$(this).siblings('.sub-menu').children('li').css('display', 'block');
				$('.head-menu-c').children(this).siblings('.sub-menu').css('display', 'block');
			}
			else{
				$(this).siblings('.sub-menu').css('display', 'none');
				$(this).siblings('.sub-menu').children('li').css('display', 'none');
				$('.head-menu-c').children(this).siblings('.sub-menu').css('display', 'none');
			}
		});
	}
	if( $(window).width() > 600 ){
		if($('#zi1').children('.zi-box').length == 3){
			$('#zi1').removeClass('jc-sa').addClass('jc-sb');
		}
		if($('#zi2').children('.zi-box').length < 3){
			$('#zi2').children('.zi-box').css('width', '33%');
		}
		if($('#zi2').children('.zi-box').length == 4){
			$('#zi2').children('.zi-box').css('width', '24%');
			$('#zi2').removeClass('jc-sa').addClass('jc-sb');
		}
		if($('.blog-wrap').children('.blog-card').length == 3){
			$('.blog-wrap').removeClass('jc-sa').addClass('jc-sb');
		}
	}
}
	//	Mobile выпадающее меню
	if( $(window).width() < 600 ){
		$(".head-menu-c .menu-item-has-children > a").after('<button class="menu-btn">+</button>');
	}

	// Мой профиль - Сохранить (ajax)
	$('.profile-tabs-content form').submit(function(){
		var $form = $(this);
		var s = $form.find('input[type="submit"]');
		var w = s.width();
		s.val('...');
		
		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(){
				s.css('background-color', 'green');
				s.val('Сохранено');
			}
		}).fail(function() {
			s.val('Ошибка');
		});
		s.width(w);
		
		return false;
	});


// Добавить в корзину
$('.addtocart').on('click', function() {
	var obj_elem = $(this);

	if( obj_elem.attr("disabled") == "disabled" ){
		return false;
	}

	if(obj_elem.attr('data-disabled') == "1"){
		return false;
	}

	obj_elem.attr('data-disabled', "1");

	var body = obj_elem.html();
	var product_id = +obj_elem.attr('data-product_id');
	var product_link = obj_elem.attr('data-product_link');
	var count = +$(".quantity__count[data-product_id = "+product_id+"]").val();
	if(!count) { count = 1; }
	var c = "";

	var select_variation = $('.usam_select_variation');
	var variation = select_variation.val();
	
	if( variation == 0){
		show_tooltip(select_variation, "Выберите вариант товара", 2000);
		select_variation.addClass('bg-clr-2 clr-white');
		setTimeout(function(){ select_variation.removeClass('bg-clr-2 clr-white') }, 1000);
		setTimeout(function(){ obj_elem.attr("data-disabled", "0"); }, 1000);
		return false;
	}

	$.post(product_link+"?usam_ajax_action=add_to_cart",{product_id: product_id, usam_action: "add_to_cart",usam_quantity: count, variation: variation}, function(data)
	{
		var resp = JSON.parse(data);
		if( resp.is_successful ){
			var count = resp.obj.count.split(' ');
			count = count[0];
			var price_cart = resp.obj.price_cart;

			updateCountBasket(count);
			updatePriceBasket(price_cart);

			if(obj_elem.hasClass('button_big')){
				c = "success_bg-clr";
			}
			if(obj_elem.hasClass('button_mini')){
				show_tooltip(obj_elem, "Товар добавлен в корзину", 2000);
				c = "success_clr";
			}
			obj_elem.addClass(c).html(body);	
			setTimeout(function(){ obj_elem.removeClass(c); }, 2000);
			setTimeout(function(){ obj_elem.attr("data-disabled", "0"); }, 2000);
		}
	});

	spinner(obj_elem);
	return false;
});

// Количество товара - Добавить в корзину
$('.quantity__plusminus').on('click', function() {
	var obj_elem = $(this);
	var product_id = +obj_elem.attr('data-product_id');
	if(product_id){
		var value = obj_elem.val();
		var quantity__count = $(".quantity__count[data-product_id = "+product_id+"]");
		var count = +quantity__count.val();
		var max = +quantity__count.attr("max");

		if(value == "+"){
			if(count < max) {
				if(count >= 1)  {
					count++;
					$(quantity__count).val(count);
					return false;
				}
			}
			else{
				alert("Извините, но есть только "+count+" единиц этого товара");
			}
		}
		if(value == "-"){
			if(count >= 2)  {
				count--;
				quantity__count.val(count);
				return false;
			}
		}
		return false;
	}
});

//		AJAX - Добавить/удалить в избранное, в сравнение
$('.add_fc').on('click', function(event) {
	var obj_elem = $(this);

	if(obj_elem.attr('data-disabled') == "1"){
		return false;
	}

	obj_elem.attr('data-disabled', "1");

	var product_id = +obj_elem.attr('data-product_id');
	var ajax_action = obj_elem.attr('data-ajax_action');
	var body = obj_elem.html();
	var url = obj_elem.attr('href');
	var c = "";

	$.get(url, function(data) {
		var resp = JSON.parse(data);
		if( resp.is_successful ){
			if( resp.obj.text.indexOf("Недоступно для неавторизованных пользователей") > 0 ){
				show_tooltip(obj_elem, "Недоступно для неавторизованных пользователей", 2000);
			}
			else{
				if( resp.obj.class == "yes"){
					obj_elem.removeClass('clr-1');
					obj_elem.addClass('clr-2');
					c = "success_clr";

					if(ajax_action == "desired_product"){
						show_tooltip(obj_elem, "Товар добавлен в избранное", 2000);
					}
					if(ajax_action == "compare_product"){
						show_tooltip(obj_elem, "Товар добавлен к сравнению", 2000);
					}
				}
				if( resp.obj.class == "no"){
					obj_elem.removeClass('clr-2');
					obj_elem.addClass('clr-1');
					if(ajax_action == "desired_product"){
						show_tooltip(obj_elem, "Товар удалён из избранного", 2000);
					}
					if(ajax_action == "compare_product"){
						show_tooltip(obj_elem, "Товар удалён из сравнения", 2000);
					}
				}
				obj_elem.addClass(c);
				setTimeout(function(){ obj_elem.removeClass(c); }, 2000);
			}
			obj_elem.html(body);
			setTimeout(function(){ obj_elem.attr('data-disabled', "0"); }, 2000);
		}
	});
	spinner(obj_elem);
	return false;
});

//		AJAX - Удалить из страницы избранного, из страницы сравнения
$('.item-card__rm').on('click', function() {
	var obj_elem = $(this);
	var ajax_action = obj_elem.attr('data-ajax_action');
	var url = obj_elem.attr('href');

	$.get(url, function(data) {
		var resp = JSON.parse(data);
		if( resp.is_successful ){
			if( resp.obj.class == "no"){
				if(ajax_action == "compare_product"){
					var ind = obj_elem.parents("td").index();
					obj_elem.parents("td").remove();
					$('.tcomparison tbody tr').each(function(i,elem) {
						$(elem).children('td').eq(ind).remove();
					});
				}
				if(ajax_action == "desired_product"){
					obj_elem.parents(".item-card").remove();
				}
			}
		}
	});
	spinner(obj_elem);
	return false;
});

// Быстрый просмотр
$('.item-card__quick-view').on('click', function() {
	var obj_elem = $(this);
	var product_id = +obj_elem.attr('data-product_id');
	var body = obj_elem.html();
	$.get(ajaxurl+"?action=quickview&product_id="+product_id, function(data) {
		$('#popup_box').html(data);
		$('#popup').css('display', 'block');
		obj_elem.html(body);
	});
	spinner(obj_elem);
	return false;
});
$('#popup').on('click', function(e) {
	if (e.target == this){
		$('#popup').css('display', 'none');
		$('#popup_box').html('');
		$('html').css('overflow', 'auto');
	}
	return false;
});

// Вкладки :: Страница профиля
$('.profile-tabs > a').on('click', function() {
	var obj_elem = $(this);
	var ind = obj_elem.index();
	$('.profile-tabs > a').removeClass('active');
	obj_elem.addClass('active');
	show_tab(".profile-tabs-content > div", ind);
	return false;
});

// Иконка загрузки при нажатии (корзина)
$('.loading').on('click', function() {
	var w = $(this).width();
	$(this).html('<i class="fas fa-spinner fa-pulse"></i>');
	$(this).width(w);
});

function show_tab(elem, ind){
	$(elem).hide();
	$(elem).eq(ind).show();
}
function updateCountBasket(count){
	$(".basket__count").text(count);
}
function updatePriceBasket(price_cart){
	$(".basket__price").text(price_cart);
}
function spinner(obj_elem){
	obj_elem.children('i').removeClass();
	obj_elem.children('i').addClass('fas fa-spinner fa-pulse');
}
function show_tooltip(obj_elem, text, time){
	if (!obj_elem) return;
	if (!time) time = 2000;
	var tooltip = $('<div>', { class: 'tooltip', text: text, css: {  } }).appendTo("body");

	// top: obj_elem.offset().top - tooltip.outerHeight() - 5,
	tooltip.css({
		top: obj_elem.offset().top - tooltip.outerHeight() - obj_elem.outerHeight(),
		left: obj_elem.offset().left - tooltip.outerWidth() / 2
	});
	setTimeout(function(){ tooltip.remove() }, time);
}
$(window).on('load resize',windowSize);

});
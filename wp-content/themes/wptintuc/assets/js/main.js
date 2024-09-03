(function ($, window) {
	// longcoder //
	if ($(".btn_video").length > 0) {
		var videoSrc = "";
		var video = $("#video");
		var videoUrl = $("#videoUrl");

		$(document).on("click", "button.btn_video", function (e) {
			e.preventDefault();
			videoSrc = $(this).data("src");
		});

		videoUrl.on("shown.bs.modal", function (e) {
			video.attr(
				"src",
				videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
			);
		});

		videoUrl.on("hide.bs.modal", function (e) {
			videoSrc = "";
			video.attr("src", videoSrc);
		});
	}
	// Create space from the header downwards
	paddingBody();
	$(window).on("load resize", paddingBody);
	function paddingBody() {
		if ($(window).width < 992) {
			var heightHeader = $(".header").height();
			$("body").css("padding-top", heightHeader);
		}
	}

	var header_sub_icon = $("<span></span>", {
		class: "header__subIcon",
	});
	$(".header ul.menu > li.menu-item-has-children").append(header_sub_icon);

	var header_toggle = $(".header__toggle");
	$("main").on("click", function () {
		if (!$(this).hasClass("menu__openSp")) return;
		header_toggle.click();
	});

	header_toggle.on("click", function () {
		$(this)
			.parents(".header")
			.find(".header__wrap")
			.toggleClass("header__wrap--active");
		$(this).parents(".header").find(".header__toggleItem").toggle();
		$("body").toggleClass("mobile-menu-open");
		$("main").toggleClass("menu__openSp");
	});

	// dropdown for multilingual section
	var header_lang = $(".header__lang");
	if (header_lang.length > 0) {
		header_lang.each(function () {
			$(this).find("ul").hide();
			// lang footer
			var langSelect = $("<div>").addClass("lang_select");
			var langCurrentUl = $("<ul>").addClass("lang_current");
			var langCurrentLi = $(this).find("ul > li.current-lang").html();
			var dropDownSpan = $("<span>").addClass("drop_down");
			var svg = `<svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.45117 1L7.45117 7L13.4512 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            `;
			langCurrentUl.on("click", function () {
				$(".lang_option").toggle();
				$(".drop_down").toggleClass("drop_down--open");
			});
			dropDownSpan.append(svg);
			langCurrentUl.append(langCurrentLi, dropDownSpan);
			var langOptionUl = $("<ul>").addClass("lang_option");
			var htmlListLang = "";
			$(this)
				.find("ul > li")
				.each(function (index, item) {
					if (!$(item).hasClass("current-lang")) {
						htmlListLang += $(item).html();
					}
				});
			langOptionUl.append(htmlListLang);
			langSelect.append(langCurrentUl, langOptionUl);
			$(this).append(langSelect);
			$(this)
				.find(".lang_current > a")
				.attr("href", "javascript:void(0);");
			$(this)
				.find("a[lang] > img")
				.css({ width: "24px", height: "24px" });
		});
	}

	// banner;
	var banner_slider = $(".banner__slider");
	if (banner_slider.length > 0) {
		banner_slider.slick({
			dots: true,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 5000,
			fade: true,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
					},
				},
			],
		});
	}

	var selectFilter = $(".tourFilter__select");
	if (selectFilter.length > 0) {
		selectFilter.each(function () {
			let placeholder = $(this).data("placeholder");
			$(this).select2({
				placeholder: placeholder,
				minimumResultsForSearch: -1,
			});
		});

		$("#area")
			.on("change", function () {
				var destinations = $(this)
					.find("option:selected")
					.data("destination");
				if (destinations) {
					var arr_id;
					if (destinations == "all") {
						arr_id = "all";
					} else {
						arr_id = destinations.split("-").filter(Boolean);
					}

					$.ajax({
						type: "post",
						dataType: "json",
						url: url_ajax,
						data: {
							action: "dia_diem",
							data: arr_id,
						},
						success: function (response) {
							if (response) {
								$("#destinations").empty();
								$("#destinations").select2({
									data: response,
									minimumResultsForSearch: -1,
								});

								if (destination_active) {
									console.log(destination_active);
									$("#destinations")
										.val(destination_active)
										.trigger("change");
								}
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							console.log(jqXHR, textStatus, errorThrown);
						},
					});
				}
			})
			.trigger("change");
	}

	if ($(".introduction__slider").length > 0) {
		$(".introduction__slider").slick({
			arrows: true,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
		});
	}

	var topTen = $(".topTen");
	if (topTen.length > 0) {
		top_ten_func();
		$(window).on("load resize", top_ten_func);

		function top_ten_func() {
			if ($(window).width() > 992) {
				let w_area = topTen.find(".area").outerWidth();
				let h_area = topTen.find(".area").outerHeight();
				$(".topTen__heading").width(w_area + 2);
				$(".topTen__heading").height(h_area * 2 + 32);
				$(".topTen__heading").css("top", h_area + 30);
			} else {
				$(".topTen__heading").width("100%");
				$(".topTen__heading").height("auto");
				$(".topTen__heading").css("top", "unset");
			}
		}
	}

	var explore_gallery = $(".explore__gallery");
	if (explore_gallery.length > 0) {
		explore_gallery.slick({
			dots: true,
			arrows: true,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						dots: false,
					},
				},
			],
		});
	}

	var tourHighlights = $(".tourHighlights__list");
	if (tourHighlights.length > 0) {
		tourHighlights.slick({
			dots: true,
			arrows: true,
			autoplay: true,
			slidesToShow: 2,
			rows: 2,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: true,
						dots: false,
						slidesToShow: 1,
						rows: 1,
					},
				},
			],
		});

		if ($(window).width() < 992) {
			$(".tourHighlightsItem__title").matchHeight();
			$(".tourHighlightsItem__desc").matchHeight();
		}
	}

	var testimonials = $(".testimonials__list");
	if (testimonials.length > 0) {
		testimonials.slick({
			autoplay: true,
			dots: true,
			autoplaySpeed: 5000,
			slidesToShow: 1,
			slidesToScroll: 1,
			vertical: true,
			verticalSwiping: true,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						vertical: false,
						verticalSwiping: false,
					},
				},
			],
		});

		if ($(window).width() >= 992) {
			var maxHeight = -1;
			$(".testimonials__list .slick-slide").each(function () {
				if ($(this).height() > maxHeight) {
					maxHeight = $(this).height();
				}
			});

			$(".testimonials__list .slick-slide").css(
				"height",
				maxHeight + "px"
			);
		}
	}

	var bannerTour_slider = $(".bannerTour__slider");
	if (bannerTour_slider.length > 0) {
		bannerTour_slider.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
		});
	}

	var bannerTour = $(".bannerTour");
	if (bannerTour.length > 0) {
		banner_tour_padding();
		$(window).on("load resize", banner_tour_padding);
	}

	function banner_tour_padding() {
		if ($(window).width() > 992) {
			let w_container = bannerTour.find(".container").width();
			let m_container = ($(window).width() - w_container) / 2;
			bannerTour
				.find(".bannerTour__content")
				.css("padding-right", m_container);
		}
	}

	// infoBranch List
	var infoBranchs = $(".infoBranch__list");
	if (infoBranchs.length > 0) {
		infoBranchs.slick({
			infinite: true,
			arrows: true,
			slidesToShow: 1,
			autoplay: true,
			autoplaySpeed: 5000,
			vertical: true,
			verticalSwiping: true,
			adaptiveHeight: true,
			variableHeight: true,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						vertical: false,
						verticalSwiping: false,
						arrows: false,
						dots: true,
					},
				},
			],
		});

		if ($(window).width() >= 992) {
			var maxHeight = -1;
			$(".branchUs .slick-slide").each(function () {
				if ($(this).height() > maxHeight) {
					maxHeight = $(this).height();
				}
			});

			$(".branchUs .slick-slide").css("height", maxHeight + "px");
		}
	}

	var backTop = $(".backTop");
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			backTop.fadeIn();
		} else {
			backTop.fadeOut();
		}
	});
	backTop.click(function () {
		$("html, body").animate({ scrollTop: 0 }, 800);
		return false;
	});

	// featureTour__list : Our Team ourTeam__sliders
	var ourTeam__sliders = $(".ourTeam__sliders");

	if (ourTeam__sliders.length > 0) {
		ourTeam__sliders.slick({
			arrows: true,
			autoplay: true,
			slidesToShow: 3,
			centerMode: true,
			centerPadding: "100px",
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: true,
						centerMode: false,
						slidesToShow: 2,
					},
				},
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						slidesToShow: 1,
						centerMode: false,
						dots: true,
					},
				},
			],
		});
	}

	//Accordion Scroll
	$(".accordion__btn").on("click", function () {
		var accordion__item = $(this).parents(".accordion__item").attr("id");
		var target = $('.navDetail__item[data-id="' + accordion__item + '"]');
		$(".navDetail__item").removeClass("active");
		target.addClass("active");
	});

	$(".navDetail__item").on("click", function () {
		var targetId = $(this).data("id");

		var accID = $("#" + targetId);

		if (accID.length > 0) {
			$(".navDetail__item").removeClass("active");
			$(this).addClass("active");
			$("html, body").animate(
				{
					scrollTop: accID.offset().top - 100,
				},
				500
			);
			accID
				.find('.collapse[data-parent="#' + targetId + '"]')
				.addClass("show");
		}
	});

	// Package Tour:  gallery image
	$(".banner__slider--background").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		fade: true,
		asNavFor: ".detailCruiSlide",
	});

	var detailCruiSlide = $(".detailCruiSlide__wrapper");
	if (detailCruiSlide.length > 0) {
		detailCruiSlide_padding();
		$(window).on("load resize", detailCruiSlide_padding);

		detailCruiSlide;
		$(".detailCruiSlide").slick({
			infinite: true,
			slidesToShow: 4.3,
			autoplaySpeed: 3000,
			arrows: false,
			asNavFor: ".banner__slider--background",
			focusOnSelect: true,
			autoplay: true,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 2.5,
					},
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1.2,
						infinite: false,
					},
				},
			],
		});
	}

	function detailCruiSlide_padding() {
		detailCruiSlide.each(function () {
			let w_container = $(".container").eq(1).width();
			let m_container = ($(window).width() - w_container) / 2;
			$(this).css("padding-left", m_container);
		});
	}

	//
	var btn_daily_tour = $("#btn_daily_tour");
	if (btn_daily_tour.length > 0) {
		btn_daily_tour.on("click", function () {
			var url = btn_daily_tour.data("url");
			var tourFilter = btn_daily_tour.parents(".tourFilter");
			var area = tourFilter.find('select[name="area"]');
			var destination = tourFilter.find('select[name="destination"]');
			var duration = tourFilter.find('select[name="duration"]');

			if (list_ha_long.includes(parseInt(destination.val()))) {
				window.location.href = page_cruises_tour;
			} else {
				window.location.href =
					url +
					"?area=" +
					area.val() +
					"&destination=" +
					destination.val() +
					"&duration=" +
					duration.val();
			}
		});
	}

	var btn_package_tour = $("#btn_package_tour");
	if (btn_package_tour.length > 0) {
		btn_package_tour.on("click", function () {
			var url = btn_package_tour.data("url");
			var tourFilter = btn_package_tour.parents(".tourFilter");
			// input filter
			var area = tourFilter.find('select[name="area"]');
			var style_travel = tourFilter.find('select[name="style_travel"]');
			var duration = tourFilter.find('select[name="duration"]');

			// window.location
			window.location.href =
				url +
				"?area=" +
				area.val() +
				"&style_travel=" +
				style_travel.val() +
				"&duration=" +
				duration.val();
		});
	}

	var btn_cruises_tour = $("#btn_cruises_tour");
	if (btn_cruises_tour.length > 0) {
		btn_cruises_tour.on("click", function () {
			var url = btn_cruises_tour.data("url");
			var tourFilter = btn_cruises_tour.parents(".tourFilter");
			// input filter
			var cruise_name =
				tourFilter.find('input[name="cruise_name"]').val() ?? "";
			var route = tourFilter.find('select[name="route"]');
			var type = tourFilter.find('select[name="type"]');
			var duration = tourFilter.find('select[name="duration"]');

			// window.location
			window.location.href =
				url +
				"?cruise_name=" +
				cruise_name +
				"&route=" +
				route.val() +
				"&duration=" +
				duration.val() +
				"&type=" +
				type.val();
		});
	}

	// scroll hide/show menu
	if ($(window).width() >= 992) {
		var lastScrollTop = 0;
		var delta = 2;
		var header = $(".header");

		$(window).scroll(function () {
			var st = $(this).scrollTop();

			if (Math.abs(lastScrollTop - st) > delta) {
				if (st > lastScrollTop && st > header.height()) {
					header.addClass("header__scrollUp");
				} else {
					header.removeClass("header__scrollUp");
				}

				lastScrollTop = st;
			}
		});
	} else {
		if ($("body").hasClass("mobile-menu-open")) {
			$(window).on("scroll", function (e) {
				e.preventDefault();
			});
		}
	}

	var banner_tour_daily = $(".bannerTour--daily");
	if (banner_tour_daily.length > 0) {
		banner_tour_daily_padding();
		$(window).on("load resize", banner_tour_daily_padding);
	}

	function banner_tour_daily_padding() {
		banner_tour_daily.each(function () {
			let w_container = $(".container").eq(1).width();
			let m_container = ($(window).width() - w_container) / 2;
			$(this).css("padding-right", m_container);

			if ($(window).width() > 992) {
				$(this).css("padding-right", m_container);
				$(this).find(".bannerTour__inner").removeClass("container");
			} else {
				$(this).css("padding-right", 0);
				$(this).find(".bannerTour__inner").addClass("container");
			}
		});
	}

	var rev = $(".rev_slider");
	if (rev.length > 0) {
		rev.on("init", function (event, slick, currentSlide) {
			var cur = $(slick.$slides[slick.currentSlide]),
				next = cur.next(),
				prev = cur.prev();
			prev.addClass("slick-sprev");
			next.addClass("slick-snext");
			cur.removeClass("slick-snext").removeClass("slick-sprev");
			slick.$prev = prev;
			slick.$next = next;
		}).on("beforeChange", function (event, slick, currentSlide, nextSlide) {
			var cur = $(slick.$slides[nextSlide]);
			slick.$prev.removeClass("slick-sprev");
			slick.$next.removeClass("slick-snext");
			(next = cur.next()), (prev = cur.prev());
			prev.prev();
			prev.next();
			prev.addClass("slick-sprev");
			next.addClass("slick-snext");
			slick.$prev = prev;
			slick.$next = next;
			cur.removeClass("slick-next").removeClass("slick-sprev");
		});

		rev.slick({
			arrows: true,
			dots: false,
			centerMode: true,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						centerMode: false,
					},
				},
			],
		});
	}

	// when submit form
	$(".wpcf7-form").on("submit", function () {
		$('input[type="submit"]').addClass("pointer-events");
	});

	// submit error or success
	document.addEventListener(
		"wpcf7submit",
		function (event) {
			$('input[type="submit"]').removeClass("pointer-events");
		},
		false
	);

	// -------------------- vucoder -------------------//
	// Related Blog
	var relatedBlog = $(".relatedBlog__list, .tourBlog__list");
	if (relatedBlog.length > 0) {
		relatedBlog.slick({
			dots: true,
			arrows: true,
			slidesToShow: 2,
			rows: 2,
			autoplay: true,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: true,
						dots: false,
						slidesToShow: 1,
						rows: 1,
					},
				},
			],
		});

		// Sửa lỗi kích thước
		if ($(window).width() >= 992) {
			var maxHeight = -1;
			$(".relatedBlog__list .blogItem").each(function () {
				if ($(this).outerHeight() > maxHeight) {
					maxHeight = $(this).outerHeight();
				}
			});

			console.log(maxHeight);

			$(".relatedBlog__list .blogItem").css("height", maxHeight + "px");
		}
	}

	// Related Package Tour - Daily Tour
	var tourPackage = $(".relatedPackage__list");
	if (tourPackage.length > 0) {
		tourPackage.slick({
			dots: true,
			arrows: true,
			autoplay: true,
			slidesToShow: 3,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						slidesToShow: 2,
						rows: 1,
					},
				},
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						slidesToShow: 1,
						rows: 1,
					},
				},
			],
		});
	}

	// Related Cruise Tour
	var tourCruise = $(".relatedCruise__list");
	if (tourCruise.length > 0) {
		tourCruise.slick({
			dots: true,
			arrows: true,
			autoplay: true,
			slidesToShow: 1,
			rows: 2,
			autoplaySpeed: 5000,
			pauseOnHover: false,
			pauseOnFocus: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						slidesToShow: 1,
						rows: 1,
					},
				},
			],
		});
	}

	// Button Detail Package
	var btnBookDetail = $(".btnBookDetail");
	if (btnBookDetail.length > 0) {
		btnBookDetail.on("click", function () {
			let bookTour = $(".bookTour");
			bookTour.find(".customizeTour").hide();
			bookTour.find(".contact .textarea__col").show();
		});
	}

	var btnCusTour = $(".btnCusTour");
	if (btnCusTour.length > 0) {
		btnCusTour.on("click", function () {
			let bookTour = $(".bookTour");
			bookTour.find(".customizeTour").show();
			bookTour.find(".contact .textarea__col").hide();
		});
	}

	// Scroll Detail Tour
	var priceBtn = $("#information__price");
	if (priceBtn.length > 0) {
		priceBtn.on("click", function () {
			let priceDetail = $(".priceDetail");
			if (priceDetail.length > 0) {
				$("html, body").animate(
					{
						scrollTop: priceDetail.offset().top,
					},
					300
				);
			}
		});
	}

	$(document).ready(function () {
		$(".wpcf7-form").submit(function (event) {
			event.preventDefault();
			console.log("Form submitted");
			return false;
		});
	});

	// Book This Form Submit
	var bookSubmit = $(".bookTourForm");
	if (bookSubmit.length > 0) {
		$(".bookTourSubmit").on("click", function () {
			let subTitleVal = $(".bookTour__titleInfo span").text().trim();
			if (subTitleVal) {
				$(".bookTour__subTitle").val(subTitleVal);
			}
			bookSubmit.submit();
		});
	}

	// Build Your Trip:
	$('.destination__option input[type="checkbox"]').change(function () {
		var checkboxId = $(this).data("id");
		var block = $(
			'.destination__listCheckItem[data-id="' + checkboxId + '"]'
		);

		if ($(this).prop("checked")) {
			block.show();
		} else {
			block.hide(function () {
				$(this).find('input[type="checkbox"]').prop("checked", false);
			});
		}
	});

	$("#bookThisForm").click(function () {
		$(".bookTourForm")
			.find(
				"input:text, input:password, input:file, input:email, select, textarea"
			)
			.val("");
		$(".bookTourForm ")
			.find("input:radio, input:checkbox")
			.removeAttr("checked")
			.removeAttr("selected");
	});

	// Search : Scroll detailCruiSlide
})(jQuery, window);

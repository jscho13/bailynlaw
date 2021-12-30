(function ($) {

    "use strict";

    var options = cmlmOptions ? cmlmOptions : {};

    var contentSelector = '.cmlm-content-links';

    var itemSelector = '.cmlm-category-box:not(.cmlm-hidden)';

	var storage_key = 'cmlm_hidden_categories';

    if ($('.cmlm-content-single').length) {

        contentSelector = '.cmlm-content-single';

        itemSelector = '.cmlm-category-link-list-entry';

    }

    var masonryOptions = {

        itemSelector: itemSelector,

        gutter: '.cmlm-gutter-sizer',

        percentPosition: true

    };



    function CMLM(config) {

        this.cache = {};

        this.cmlm = config.cmlm;

        this.options = config.options;

        this.masonryOptions = config.masonryOptions;

        this.init();

        this.filterInit();

        this.searchInit();

        this.tagInit();

        this.paginationInit();

		this.setListeners();

		this.paginationRebuild();

        if (cmlmOptions.user_display_categories == '1' && ($('.cmlm-content-single').length == 0) ) {

            this.visibleCategoriesInit();

        }

        // if (this.options.showCheckboxes) {

			try {

				this.checkboxInit();

			} catch (e) {

			}

        // }

    }



    CMLM.prototype.init = function () {

        var _this = this;

        _this.cache.lastEditItemTime = 0;

        _this.cache.lastCreateItemTime = 0;

        $(this.cmlm).find('.cmlm-category[data-role="category"] .cmlm-link').each(function () {

            if ($(this).data('create-time') && $(this).data('create-time') > _this.cache.lastCreateItemTime) {

                _this.cache.lastCreateItemTime = $(this).data('create-time');

            }

            if ($(this).data('edit-time') && $(this).data('edit-time') > _this.cache.lastEditItemTime) {

                _this.cache.lastEditItemTime = $(this).data('edit-time');

            }

        });

       setTimeout(function () {

           _this.updateJSPlaceholders();

            _this.masonry();

       }, 50);

        $(window).on('resize', debounce(function () {

            _this.masonry();

        }, 500));

    };



    CMLM.prototype.masonry = function () {

        var _this = this;

        var columnWidth = (100 - (_this.options.columnsCount - 1) * 3) / _this.options.columnsCount;

        var percentWidth = columnWidth + '%';

        $(_this.cmlm).find(contentSelector + ' ' + itemSelector).css('width', percentWidth);

        var elementWidth = $(_this.cmlm).find(contentSelector + ' ' + itemSelector).width();

        for (var i = 0; i < _this.options.columnsCount && elementWidth < 200; i++)

        {

            columnWidth = (100 - (_this.options.columnsCount - 1 - i) * 3) / (_this.options.columnsCount - i);

            percentWidth = columnWidth + '%';

            $(_this.cmlm).find(contentSelector + ' ' + itemSelector).css('width', percentWidth);

            elementWidth = $(_this.cmlm).find(contentSelector + ' ' + itemSelector).width();

        }

        percentWidth = columnWidth + '%';

        $(_this.cmlm).find('.cmlm-grid-sizer').width(percentWidth);

        $(_this.cmlm).find(contentSelector + ' ' + itemSelector).width(percentWidth);



        if (this.options.items_per_page == 0) {

            $(_this.cmlm).find(contentSelector).masonry($.extend({}, _this.masonryOptions, {columnWidth: '.cmlm-grid-sizer'}));

        } else {

            var $content = $(_this.cmlm).find(contentSelector).imagesLoaded(function () {

                $content.masonry($.extend({}, _this.masonryOptions, {columnWidth: '.cmlm-grid-sizer'}));

            });

        }

    };



    CMLM.prototype.updateJSPlaceholders = function () {

        var _this = this;

        var linksCount;

		let selected_cats_count = 0;

		let cats = [...$('.cmlm-filter-list-entry')].map( (current)=>{

							return parseInt($(current).find('input[type="checkbox"]').attr('checked') ? $(current).data('links-count') : 0);

					});

		if ( cats != null && cats.length ) {

			selected_cats_count = cats.reduce( (sum, curr) => sum + curr );

		}

			_this.paginationRebuild(selected_cats_count);

			if ($(_this.cmlm).find('.cmlm-bonus-info').data('total-count')) {

				linksCount = $(_this.cmlm).find('.cmlm-bonus-info').data('total-count');

			} else {

				linksCount = $(_this.cmlm).find('.cmlm-category .cmlm-category-link-list-entry:visible').length;

			}

			var lastUpdateDate = new Date(_this.cache.lastEditItemTime * 1000);

			$(_this.cmlm).find('.cmlm-js-placeholder').each(function () {

				var html = $(this).data('html');

				html = html.replace('{links-count}', selected_cats_count + '/' + linksCount);

				html = html.replace('{last-update-date}', _this.cache.lastEditItemTime ? lastUpdateDate.toDateString() : '---');

				$(this).html(html);

			});

    };



    CMLM.prototype.filter = function (arg) {
        var _this = this;



        $(_this.cmlm).find('.cmlm-filter li').removeClass('active');

        $(_this.cmlm).find('.cmlm-category').addClass('cmlm-hidden').hide();

        $(_this.cmlm).find('.cmlm-category-link-list-entry').show();

        


        arg.search && _this.filterSearch(arg);

        arg.category && _this.filterCategory(arg);

        arg.tag && _this.filterTag(arg);



        _this.updateJSPlaceholders();

        _this.masonry();

    };



    CMLM.prototype.highlight = function (s) {

        var _this = this;

        $(_this.cmlm).find('.cmlm-header').highlight(s, {className: 'cmlm-highlight'});

        $(_this.cmlm).find('.cmlm-link').highlight(s, {className: 'cmlm-highlight'});

    };



    CMLM.prototype.unhighlight = function () {

        var _this = this;

        $(_this.cmlm).find('.cmlm-header').unhighlight({className: 'cmlm-highlight'});

        $(_this.cmlm).find('.cmlm-link').unhighlight({className: 'cmlm-highlight'});

    };



    CMLM.prototype.filterSearch = function (arg) {

        var _this = this;

        $(_this.cmlm).find('.cmlm-category[data-role="category"] .cmlm-category-link-list-entry').hide();

        $(_this.cmlm).find('.cmlm-category[data-role="category"]').each(function () {

            var category = this;

            if ($(category).find('.cmlm-header').text().toLowerCase().indexOf(arg.search.toLowerCase()) > -1) {

                $(category).find('.cmlm-category-link-list-entry').show();

                $(category).removeClass('cmlm-hidden').show();

                $(category).parent().removeClass('full-width').show();

                $(_this.cmlm).find('.cmlm-filter .cmlm-filter-list-entry[data-id={id}]'.replace('{id}', $(category).data('id'))).addClass('active');

            } else {

                $(category).find('.cmlm-category-link-list-entry').each(function () {

                    var link = this;

                    if ($(link).text().toLowerCase().indexOf(arg.search.toLowerCase()) > -1) {

                        $(link).show();

                        $(category).removeClass('cmlm-hidden').show();

                        $(category).parent().removeClass('full-width').show();

                    }

                });

            }

        });

        _this.highlight(arg.search);

    }



    CMLM.prototype.filterCategory = function (arg) {
        console.log('This is the category filter');
        var _this = this;

        $(_this.cmlm).find('.cmlm-filter li').not('.cat-item-all').each(function () {

            if ($.trim($(this).data('name').toLowerCase()) === $.trim(arg.category.toLowerCase())) {

                $(this).addClass('active');

            }

            $(_this.cmlm).find('.cmlm-filter li.active').each(function () {
                
                $(_this.cmlm).find('.cmlm-category[data-id="{id}"][data-role="category"]'

                        .replace('{id}', $(this).data('id')))

                        .removeClass('cmlm-hidden')

                        .show();
                
                $(_this.cmlm).find('.cmlm-category[data-id="{id}"][data-role="category"]'
                //this allows the parent class to be full with
                        .replace('{id}', $(this).data('id')))

                        .parent()

                        .addClass('full-width')

                        .show();

                $(_this.cmlm).find('.cmlm-category[data-id="{id}"][data-role="category"] .cmlm-category'

                        .replace('{id}', $(this).data('id')))

                        .removeClass('cmlm-hidden')

                        .show();
                
                $(_this.cmlm).find('.cmlm-category[data-id="{id}"][data-role="category"] .cmlm-category'

                        .replace('{id}', $(this).data('id')))

                        .addClass('full-width')

                        .show();

            });

        });

    };



    CMLM.prototype.filterTag = function (arg) {

        var _this = this;

        $(_this.cmlm).find('.cmlm-category[data-role="tag"]').each(function () {

            if ($.trim($(this).find('.cmlm-header').text().toLowerCase()) === $.trim(arg.tag.toLowerCase())) {

                $(this).removeClass('cmlm-hidden').show();

            }

        });

    };



    CMLM.prototype.filterInit = function () {
        
        var _this = this;

        $(_this.cmlm).find('.cmlm-filter .cat-item-all').html(cmlmOptions.all_categories_label);

        if (cmlmOptions.user_display_categories == '1') {

            $(_this.cmlm).find('.cmlm-filter .cat-item-all').prepend('<input type="checkbox" name="display_category[]" checked="checked" /> ');

        }

        $(_this.cmlm).find('.cmlm-filter').on('click', 'li:not(.disabled-filter, .cat-item-all)', function () {

            var text = cmlmOptions.category_label + ': {name}';

            $(_this.cmlm).find('.cmlm-search-input')

                    .val(text.replace('{name}', $(this).data('name')))

                    .trigger('input')

                    .trigger('change');

        });

        $(_this.cmlm).find('.cmlm-filter .cat-item-all').on('click', function () {
            $(".full-width").removeClass('full-width').show();
            $(_this.cmlm).find('.cmlm-search-input').val('').trigger('change');
            console.log('this is the all button'); // this fires got to find where else it fires
            
        });

    };



    CMLM.prototype.searchInit = function () {

        var _this = this;

        $(_this.cmlm).find('.cmlm-search-input').on('change keyup paste', function () {

            _this.unhighlight();

            var s = $(this).val();

            if (!s.length) {

                $(_this.cmlm).find('.cmlm-filter li').removeClass('active');

                $(_this.cmlm).find('.cmlm-category').addClass('cmlm-hidden').hide();

                $(_this.cmlm).find('.cmlm-category[data-role="category"]').removeClass('cmlm-hidden').show();

                $(_this.cmlm).find('.cmlm-category[data-role="category"] .cmlm-category-link-list-entry').show();

                _this.updateJSPlaceholders();

                _this.masonry();

                return;

            }

            var text = cmlmOptions.category_label + ':';

            var regExp = new RegExp(text, 'g');

            if (s.match(regExp)) {

                _this.filter({category: s.slice(text.length)});

            } else if (s.match(/^tag:/)) {

                _this.filter({tag: s.slice(4)});

            } else {

                _this.filter({search: s});

            }

        });

    };



    CMLM.prototype.tagInit = function () {

        var _this = this;

        $(_this.cmlm).find('.cmlm-tag').on('click', function (e) {

            e.preventDefault();

            e.stopPropagation();

            $(_this.cmlm).find('.cmlm-search-input')

                    .val('tag: {name}'.replace('{name}', $(this).text()))

                    .trigger('input')

                    .trigger('change');

            return false;

        });

    };



    CMLM.prototype.visibleCategoriesInit = function () {

        var _this = this,

            storage = null,

            id;



        try {

            storage = JSON.parse(localStorage.getItem(storage_key));

        } catch (e) {

        }



        if (!Array.isArray(storage)) {

            storage = [];

            localStorage.setItem(storage_key, JSON.stringify(storage));

        }



        for (var i in storage) {

            id = storage[i];

            $(_this.cmlm).find('.cmlm-filter li[data-id="' + id + '"]').addClass('disabled-filter')

                    .find('input[type="checkbox"]').prop('checked', false);

            $(_this.cmlm).find('.cmlm-category[data-id="' + id + '"][data-role="category"]')

                    .addClass('cmlm-hidden-category').find('.cmlm-category').addClass('cmlm-hidden-category');

        }

        $(_this.cmlm).find('.cmlm-filter li.cat-item-all input[type="checkbox"]')

                .prop('checked', $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]:checked').length ==

                        $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]').length);

		$('.cmlm_pagination_pin.active > .cmlm-pagination-btn').trigger('click');

		_this.paginationRebuild();

		_this.masonry();



        $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]').on('click changed-value', function (e) {

            e.stopPropagation();

            var $li = $(this).parent(),

                    id = $li.data('id');

            storage = JSON.parse(localStorage.getItem(storage_key));



            if (storage.indexOf(id) > -1 && $(this).is(':checked')) {

                storage.splice(storage.indexOf(id), 1);

            }

            if (storage.indexOf(id) === -1 && !$(this).is(':checked')) {

                storage.push(id);

            }

            localStorage.setItem(storage_key, JSON.stringify(storage));



			let cats = $('.cmlm-pagination-btn').first().data('category-term-id-arr') + '';

			cats = (typeof cats != 'undefined') ? cats.split(',') : [];



			if ($(this).is(':checked')) {

                $li.removeClass('disabled-filter');

                $(_this.cmlm).find('.cmlm-category[data-id="' + id + '"][data-role="category"]')

					.removeClass('cmlm-hidden-category').find('.cmlm-category').removeClass('cmlm-hidden-category');

				const index = cats.indexOf(id+'');

				if (index == -1) {

					cats.push(id+'');

				}

            } else {

                $li.addClass('disabled-filter');

                $(_this.cmlm).find('.cmlm-category[data-id="' + id + '"][data-role="category"]')

					.addClass('cmlm-hidden-category').find('.cmlm-category').addClass('cmlm-hidden-category');

				const index = cats.indexOf(id+'');

				if (index > -1) {

					cats.splice(index, 1);

				}

			}

			cats = cats.filter(function (el) {

				return  (el != "") && (storage.indexOf(el) == -1);

			});

			$('.cmlm-pagination-btn').each(function(){

				$(this).data('category-term-id-arr',cats.join(','));

				$(this).attr('data-category-term-id-arr',cats.join(','));

			});

//			$('.cmlm-content-links').addClass('hidden');

			$('.cmlm_pagination_pin.active > .cmlm-pagination-btn').trigger('click');

			_this.updateJSPlaceholders();

            _this.masonry();

//			$('.cmlm-content-links').removeClass('hidden');



            $(_this.cmlm).find('.cmlm-filter li.cat-item-all input[type="checkbox"]')

                    .prop('checked', $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]:checked').length ==

                            $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]').length);

        });



        $(_this.cmlm).find('.cmlm-filter li.cat-item-all input[type="checkbox"]').on('click', function (e) {

            e.stopPropagation();

            var is_checked = $(this).is(':checked');

				$('.cmlm_pagination_pin.active').removeClass('active');

            $(_this.cmlm).find('.cmlm-filter li:not(.cat-item-all) input[type="checkbox"]').each(function () {

                if (is_checked) {

                    $(this).prop('checked', true).triggerHandler('changed-value');

					$('.cmlm_pagination_pin').first().addClass('active');

                } else {

                    $(this).prop('checked', false).triggerHandler('changed-value');

                }

            });

				$('.cmlm_pagination_pin.active > .cmlm-pagination-btn').trigger('click');

        });

    };



    CMLM.prototype.checkboxInit = function () {

        var _this = this;

        var lsKey = 'wp-cmlm-selected-links';

        var data = null;

        try {

            data = JSON.parse(localStorage.getItem(lsKey));

        } catch (e) {

        }

        if (data == null || data.data == null) {

            data = {data: []};

            localStorage.setItem(lsKey, JSON.stringify(data));

        }

        $(data.data).each(function (k, v) {

            $(_this.cmlm).find('.cmlm-link-checkbox input[data-id="{id}"]'.replace('{id}', v)).attr('checked', 'checked');

        });

        $(_this.cmlm).find('.cmlm-link-checkbox input').on('change', function () {

            data = JSON.parse(localStorage.getItem(lsKey));

            var id = $(this).data('id');

            var $cbx = $('.cmlm-link-checkbox input[data-id="{id}"]'.replace('{id}', id));

            $(this).is(':checked') ? $cbx.attr('checked', 'checked') : $cbx.removeAttr('checked');

            if (data.data.indexOf(id) > -1 && !$(this).is(':checked')) {

                data.data.splice(data.data.indexOf(id), 1);

            }

            if (data.data.indexOf(id) === -1 && $(this).is(':checked')) {

                data.data.push(id);

            }

            localStorage.setItem(lsKey, JSON.stringify(data));

        });

    }

    CMLM.prototype.paginationInit = function () {

        var _this = this;

		var storage = JSON.parse(localStorage.getItem(storage_key));

		var cats_arr = [];

		if ( $('.cmlm-pagination-btn').length ) {

			var cat_list = $('.cmlm-pagination-btn').first().attr('data-category-term-id-arr');

			if ( cat_list != null && cat_list.length ) {

				cats_arr = $('.cmlm-pagination-btn').first().attr('data-category-term-id-arr').split(',');

				if ( storage != null && storage.length) {

					cats_arr = cats_arr.filter( function(cat_id) {

					return storage.indexOf(parseInt(cat_id)) == -1 });

				};

				$('.cmlm-pagination-btn').each( function() {

						$(this).data('category-term-id-arr',cats_arr.join(','));

						$(this).attr('data-category-term-id-arr',cats_arr.join(','));

				});

			}

		}

    };

	CMLM.prototype.setListeners = function () {

		var _this = this;

		var pg_btn_clicked = false;

		$('body').on('click', '.cmlm-pagination-btn', function (e) {

			if (pg_btn_clicked) return false;

			pg_btn_clicked = true;

			e.preventDefault();

			e.stopPropagation();

			var data;

			var targetData = $(e.target).data();

			if ($(e.target).hasClass('single-category')) {

				data = {

					action: 'cmlm_category_pagination_single',

					page_number: targetData['pageNumber'],

					items_per_page: targetData['itemsPerPage'],

					max_page_number: targetData['maxPageNumber'],

					max_height: targetData['maxHeight'],

					term_id: targetData['termId'],

					max_links: targetData['maxLinks'],

				};

			} else {

				data = {

					action: 'cmlm_category_pagination',

					page_number: targetData['pageNumber'],

					items_per_page: targetData['itemsPerPage'],

					max_page_number: targetData['maxPageNumber'],

					list_term_id_arr: targetData['listTermIdArr'],

					category_term_id_arr: targetData['categoryTermIdArr'],

					max_height: targetData['maxHeight'],

					max_links: targetData['maxLinks'],

					tag_term_id_arr: targetData['tagTermIdArr'],

				};

			}

			$(e.target).parent().addClass('active');

			$(e.target).parent().siblings().removeClass('active');

			$('.cmlm-pagination-btn').each(function () {

				if ($(this).data('page-number') == $(e.target).data('page-number')) {

					$(this).parent().addClass('active');

					$(this).parent().siblings().removeClass('active');

				}

			});

			if ( (typeof data.category_term_id_arr == 'undefined') || (data.category_term_id_arr.length > 0) ) {

			$.ajax({

				url: cmlmOptions.ajaxurl,

				method: 'POST',

				data: data,

				beforeSend: function () {

					$('.cmlm-loader').removeClass('cmlm-hidden-loader');

				},

				success: function (data) {

					var content = '.cmlm-content-links';

					if (data.result) {

						if (data.status == 'single') {

							content = '.cmlm-category-link-list';

						}

						// console.log(data.status);

						$(content).html('');

						$(content).html(data.result);

						$(content).find('.cmlm-category').each(function () {

							if (!$(this).find('a.cmlm-link').length) {

								$(_this).find('.cmlm-filter li[data-id="{id}"]'.replace('{id}', $(this).data('id'))).remove();

								$(this).parent().remove();

							}

						});

						$(_this.cmlm).find('.cmlm-filter-list-entry').each(function () {

							var category = this;

							if ($(category).hasClass('active')) {

								var cat_id = $(category).data('id');

								$(_this.cmlm).find('.cmlm-category[data-id!="{id}"]'.replace('{id}', cat_id)).addClass('cmlm-hidden').hide();

							}



						});

						$(content).imagesLoaded(function () {

							var dataMasonry = $(_this.cmlm).find(contentSelector).data('masonry');

							$(_this.cmlm).find(contentSelector).masonry('reloadItems');

							var columnWidth = (100 - (_this.options.columnsCount - 1) * 3) / _this.options.columnsCount;

							var percentWidth = columnWidth + '%';

							$(_this.cmlm).find(contentSelector + ' ' + itemSelector).css('width', percentWidth);

							var elementWidth = $(_this.cmlm).find(contentSelector + ' ' + itemSelector).width();

							for (var i = 0; i < _this.options.columnsCount && elementWidth < 200; i++)

							{

								columnWidth = (100 - (_this.options.columnsCount - 1 - i) * 3) / (_this.options.columnsCount - i);

								percentWidth = columnWidth + '%';

								$(_this.cmlm).find(contentSelector + ' ' + itemSelector).css('width', percentWidth);

								elementWidth = $(_this.cmlm).find(contentSelector + ' ' + itemSelector).width();

							}

							percentWidth = columnWidth + '%';

							$(_this.cmlm).find('.cmlm-grid-sizer').width(percentWidth);

							$(_this.cmlm).find(contentSelector + ' ' + itemSelector).width(percentWidth);

							$(_this.cmlm).find(contentSelector).masonry($.extend({}, _this.masonryOptions,

									{columnWidth: dataMasonry.options.columnWidth, transitionDuration: '0', percentPosition: true}));

						});

						if ($('.cmlm_pagination').data('scroll') == 1) {

							var $offset = $(content).offset().top - 125;

							$('html, body').animate({scrollTop: $offset});

						}



					} else {

						console.log('error');

					}

					return true;

				},

				complete: function (data) {

					$('.cmlm-loader').addClass('cmlm-hidden-loader');

					pg_btn_clicked = false;

				}



			}).always(function (data) {

 					pg_btn_clicked = false;

				});

			}



    return false;		});

	};



	CMLM.prototype.paginationRebuild = function (links_number) {

        var _this = this;

		if ( ! $('.cmlm-pagination-btn').hasClass('single-category') ) {

			var wrapper = $('.cmlm_pagination-wrapper');

			var btns = $(wrapper).first().find('.cmlm_pagination_pin > a.cmlm-pagination-btn');

			if (btns != null && btns.length ) {

				var btn = $(btns).first(),

				items_per_page = _this.options.items_per_page,

				max_page_number = Math.ceil(links_number/items_per_page);

				for (let i = 1; i <= btns.length; i++) {

					$(wrapper).each(function() {

						$(this).find(`.cmlm_pagination_pin > a.cmlm-pagination-btn[data-page-number="${i}"]`).parent().addClass('hidden');

					});

				}

				if ( max_page_number > 1 ) {

				for (let i = 1; i <= max_page_number; i++) {

					$(wrapper).each(function() {

						$(this).find(`.cmlm_pagination_pin > a.cmlm-pagination-btn[data-page-number="${i}"]`).parent().removeClass('hidden');

					});

				}

				}

			}

		}

	};



    $(function () {



        Opentip.styles.cmlm = {

            className: 'cmlm-tooltip'

        };

        if (options.tooltipBackgroundColor) {

            Opentip.styles.cmlm.background = options.tooltipBackgroundColor;

        }

        if (options.tooltipBorderColor) {

            Opentip.styles.cmlm.borderColor = options.tooltipBorderColor;

        }



        $('.cmlm').each(function () {

            var _this = this;

            // remove empty categories

            $(_this).find('.cmlm-category').each(function () {

                if (!$(this).find('a').length) {

                    $(_this).find('.cmlm-filter li[data-id="{id}"]'.replace('{id}', $(this).data('id'))).remove();

                    $(this).remove();

                }

            });



            // run plugin

            new CMLM({

                cmlm: _this,

                options: options,

                masonryOptions: masonryOptions

            });

        });



        //tooltips

        $('.cmlm-link, .cmlm-filter li').each(function () {

			var title = $(this).attr('title');

            if (title) {

                $(this).opentip(title, {style: 'cmlm'});

                $(this).removeAttr('title');

            }

        });



        // block empty links

        $('a.cmlm-link[href=""]').addClass('cmlm-link-disabled');

        $('a.cmlm-link[href=""]').on('click', function (e) {

            e.preventDefault();

            e.stopPropagation();

            return false;

        });



        // search input "x"

        $(document).on('input', '.cmlm-clearable', function () {

            $(this)[tog(this.value)]('x');

        }).on('mousemove', '.x', function (e) {

            $(this)[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');

        }).on('touchstart click', '.onX', function (ev) {

            ev.preventDefault();

            $(this).removeClass('x onX').val('').change();

        });

        //$('.cmlm-clearable').trigger('input');



        function tog(v) {

            return v ? 'addClass' : 'removeClass';

        }



        $(document).on('click', '.cmlm-social-share-btn', function () {

            var soc_div = $(this).next('.cmlm-social');

            var width = $(soc_div).find('a').length * 27;

            if ($(soc_div).width() == 0) {

                $(soc_div).width(width + 'px');

            } else {

                $(soc_div).width(0);

            }

        })

        $(document).on('mouseenter', '.onhover', function () {

            var soc_div = $(this).find('.cmlm-social-share-btn').next('.cmlm-social');

            var width = $(soc_div).find('a').length * 27;

            $(soc_div).width(width + 'px');

        })

        $(document).on('mouseleave', '.onhover', function () {

            var soc_div = $(this).find('.cmlm-social-share-btn').next('.cmlm-social');

            $(soc_div).width(0);

        })



    });



    //https://davidwalsh.name/javascript-debounce-function

    function debounce(func, wait, immediate) {

        var timeout;

        return function () {

            var context = this, args = arguments;

            var later = function () {

                timeout = null;

                if (!immediate)

                    func.apply(context, args);

            };

            var callNow = immediate && !timeout;

            clearTimeout(timeout);

            timeout = setTimeout(later, wait);

            if (callNow)

                func.apply(context, args);

        };

    }



    $('body').on('click', '.cmlm-like-btn', function (e) {

        e.preventDefault();

        var _this = this;

        $.ajax({

            url: cmlmOptions.ajaxurl,

            method: 'POST',

            data: {

                action: 'cmlm_link_liked',

                link_id: $(_this).data('link-id'),

                ip_address: $(_this).data('ip-address')

            }

        }).always(function (data) {

            if (data.status) {

                // console.log(data.status);

                var num = parseInt($(_this).parent().find('span').html()) + 1;

                $(_this).parent().find('span').html(num)

                $(_this).parent().find('.cmlm-like-btn-img').animate({

                    width: "22px"

                }, 100, function () {

                    $(this).animate({

                        width: "18px"

                    }, 100)

                });

                $(_this).hide();

            } else {

                console.log('error');

            }

        });



    });



    $('body').on('click', '.cmlm-thumbsup', function (e) {

        e.preventDefault();

        var _this = this;

        $.ajax({

            url: cmlmOptions.ajaxurl,

            method: 'POST',

            data: {

                action: 'cmlm_link_thumbsup',

                link_id: $(_this).data('link-id'),

                ip_address: $(_this).data('ip-address')

            }

        }).always(function (data) {

            if (data.status) {

                var score_el = $('.cmlm-score_count[data-link-id="' + data.link_id + '"]');

                var button_el = $('.cmlm-vote[data-link-id="' + data.link_id + '"]');

                if (score_el.length) {

                    score_el.html(data.newscore);

                }

                if (button_el.length) {

                    button_el.attr('disabled', true);

                    button_el.addClass('disabled');

                }

            } else {

                console.log('error');

            }

        });



    });



    $('body').on('click', '.cmlm-thumbsdown', function (e) {

        e.preventDefault();

        var _this = this;

        $.ajax({

            url: cmlmOptions.ajaxurl,

            method: 'POST',

            data: {

                action: 'cmlm_link_thumbsdown',

                link_id: $(_this).data('link-id'),

                ip_address: $(_this).data('ip-address')

            }

        }).always(function (data) {

            if (data.status) {

                var score_el = $('.cmlm_score_count[data-link-id="' + data.link_id + '"]');

                var button_el = $('.cmlm_vote[data-link-id="' + data.link_id + '"]');

                if (score_el.length) {

                    score_el.html(data.newscore);

                }

                if (button_el.length) {

                    button_el.attr('disabled', true);

                    button_el.addClass('disabled');

                }

            } else {

                console.log('error');

            }

        });



    });



})(jQuery);


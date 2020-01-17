// 
// How to use:
//
// $('#price,#sum').cleave({ numeral: true, numeralThousandsGroupStyle: 'thousand', autoUnmask: true});
//
// or use pre-defined sets:
//
// $('#price').cleave('money');
// $('#date_at').cleave('date');
// $('#qty').cleave('integer');
//
(function($, window, undefined){ 'use strict'

  $.fn.cleave = function(opts) {

    var defaults = {autoUnmask: false}, options = {};

    var defDate    = {date: true, datePattern: ['d','m','Y'], delimiter: '-'},
        defTime    = {numericOnly: true, delimiters: [':'], blocks: [2, 2]},
        defDateTime= {numericOnly: true, delimiters: ['-', '-', ' ', ':'], blocks: [2, 2, 4, 2, 2]},
        defMoney   = {numeral: true, numeralThousandsGroupStyle: 'thousand', numeralPositiveOnly: true, autoUnmask: true},
        defInteger = {numeral: true, numeralThousandsGroupStyle: 'thousand', numeralPositiveOnly: true, autoUnmask: true, numeralDecimalScale: 0};

    if( typeof opts === 'string') {
      switch( opts ) {
        case 'date':     $.extend(options, defaults, defDate);     break;
        case 'time':     $.extend(options, defaults, defTime);     break;
        case 'datetime': $.extend(options, defaults, defDateTime); break;
        case 'money':    $.extend(options, defaults, defMoney);    break;
        case 'integer':  $.extend(options, defaults, defInteger);  break;
      }
    } else if( $.isPlainObject( opts ) ) {
      $.extend(options, defaults, opts || {});
    }

    return this.each(function(){

      if( this.id == undefined || this.id == null || this.id == '' ) {
        throw 'jquery-cleave.js requires objectID to be initialized';
      }

      var cleave = new Cleave('#'+this.id, options), $this = $(this);

      $this.data('cleave-auto-unmask', options['autoUnmask']);;
      $this.data('cleave',cleave)
    });
  }

  var origGetHook, origSetHook;

  if ($.valHooks.input) {

    origGetHook = $.valHooks.input.get;
    origSetHook = $.valHooks.input.set;

  } else {

    $.valHooks.input = {};
  }

  $.valHooks.input.get = function (el) {

    var $el = $(el), cleave = $el.data('cleave');

    if( cleave ) {

      return $el.data('cleave-auto-unmask') ? cleave.getRawValue() : el.value;

    } else if( origGetHook ) {

      return origGetHook(el);

    } else {

      return undefined;
    }
  }

  $.valHooks.input.set = function (el,val) {

    var $el = $(el), cleave = $el.data('cleave');

    if( cleave ) {

      cleave.setRawValue(val);
      return $el;

    } else if( origSetHook ) {

      return origSetHook(el);

    } else {
      return undefined;
    }
  }
})(jQuery, window);

/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="delete" name="delete_item">Delete</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with delete forms everywhere.
 */
function addDeleteForms() {
    $('[data-method]').append(function () {
            if (!$(this).find('form').length > 0) {
                return "\n<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                    "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                    "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" +
                    '</form>\n';
            } else {
                return ''
            }
        })
        .attr('href', '#')
        .attr('style', 'cursor:pointer;')
        .attr('onclick', '$(this).find("form").submit();');
}

/**
 * Place any jQuery/helper plugins in here.
 */
$(function () {
    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * Disable all submit buttons once clicked
     */
    $('form').submit(function () {
        $(this).find('input[type="submit"]').attr('disabled', true);
        $(this).find('button[type="submit"]').attr('disabled', true);
        return true;
    });

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();

        const form = this;
        const link = $('a[data-method="delete"]');
        const cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : 'Cancel';
        const confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : 'Yes, delete';
        const title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : 'Are you sure you want to delete this item?';

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'warning'
        }).then((result) => {
            result.value && form.submit();
        });
    }).on('click', 'a[name=confirm_item]', function (e) {
        /**
         * Generic 'are you sure' confirm box
         */
        e.preventDefault();

        const link = $(this);
        const title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : 'Are you sure you want to do this?';
        const cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : 'Cancel';
        const confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : 'Continue';

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'info'
        }).then((result) => {
            result.value && window.location.assign(link.attr('href'));
        });
    });

    /* cleaver.js
     */
    $('.input-element-number').each((i, el) => {
        //$(el).cleave({ numeral: true, numeralThousandsGroupStyle: 'thousand', autoUnmask: true});
    });
});

// You can replace this with you own init script, e.g.:
// - jQuery(document).ready()
window.onload = function () {
    if (window.Quill) {
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],

            [{
                'header': 1
            }, {
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'], // remove formatting button
            ['link', 'image', 'video']
        ];
        $('div.quill-editor').each((i, el) => {
            var quill = new Quill(el, {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
        });
    }
}


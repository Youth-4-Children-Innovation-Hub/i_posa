<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IPOSA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- select cdn -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <style>
        .search {
            background-color: white;
            padding-right: 6px;
            padding-left: 6px;
            padding-top: 2px;
            padding-bottom: 2px;
            border: 1px solid white;
            border-radius: 15px;
        }

        .search button {
            border: 0px solid white;
            background-color: white;

        }

        #search_text {
            outline: none;
            border: 0px;

        }

        #exampleFormControlSelect1 {
            border: 1px solid white;
            padding-left: 20px;
            padding-right: 20dp;
            outline: none;
            margin-left: 5px;
            border-radius: 15px;
        }

        #paginate {
            background-color: white;
        }

        #paginate button {
            border: solid 0px white;
            background-color: orange;
            color: white;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <div id="app">
      <br> <br>
        <main class="py-4">
            
            @yield('login')
        </main>
    </div>


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.all.min.js"></script>

@if(session('sweet_success'))
<script>
   Swal.fire({
       icon: 'success',
       title: 'Success!',
       text: '{{ session('sweet_success') }}',
       confirmButtonColor: '#28a745'
   });
   </script>
   @endif
   
   @if(session('sweet_error'))
   <script>
   Swal.fire({
       icon: 'error',
       title: 'Error!',
       text: '{{ session('sweet_error') }}',
       confirmButtonColor: '#dc3545'
   });
</script>
@endif

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- deselect -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>


    <!-- select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        // Global AJAX form handler (opt-in via class="js-ajax-form")
        // - Prevents full page reload
        // - Supports multipart/form-data via FormData
        // - Displays Laravel validation errors (422) either per-field (#error-field) or as a list (.js-form-errors)
        (function () {
            function setSubmitting($form, isSubmitting) {
                var $btn = $form.find('button[type="submit"], input[type="submit"]').first();
                if (!$btn.length) return;

                if (isSubmitting) {
                    $btn.data('original-text', $btn.is('button') ? $btn.html() : $btn.val());
                    $btn.prop('disabled', true);
                    if ($btn.is('button')) {
                        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Saving...');
                    } else {
                        $btn.val('Saving...');
                    }
                } else {
                    var original = $btn.data('original-text');
                    $btn.prop('disabled', false);
                    if (original !== undefined) {
                        if ($btn.is('button')) $btn.html(original);
                        else $btn.val(original);
                    }
                }
            }

            function clearErrors($form) {
                $form.find('.js-form-errors').hide().empty();
                $form.find('.is-invalid').removeClass('is-invalid');

                // Clear per-field containers
                $form.find('[id^="error-"]').each(function () {
                    $(this).text('').hide();
                });
            }

            function showErrors($form, errors) {
                var firstField = null;
                var listItems = [];

                $.each(errors, function (field, messages) {
                    var msg = Array.isArray(messages) ? messages[0] : messages;
                    listItems.push('<li>' + String(msg) + '</li>');

                    var $input = $form.find('[name="' + field + '"]');
                    var $error = $form.find('#error-' + field);

                    if ($input.length) {
                        $input.addClass('is-invalid');
                        if (!firstField) firstField = $input;

                        // bootstrap-select support
                        if ($input.hasClass('selectpicker') && $input.selectpicker) {
                            try { $input.selectpicker('setStyle', 'is-invalid', 'add'); } catch (e) {}
                        }
                    }

                    if ($error.length) {
                        $error.text(msg).show();
                    }
                });

                // If there are no per-field error slots, show a list container if present
                var $list = $form.find('.js-form-errors');
                if ($list.length && listItems.length) {
                    $list.html('<ul class="m-0 ps-3">' + listItems.join('') + '</ul>').show();
                } else if (typeof Swal !== 'undefined' && listItems.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: '<ul style="text-align:left; margin:0; padding-left:18px;">' + listItems.join('') + '</ul>'
                    });
                }

                if (firstField && firstField[0]) {
                    firstField[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            function buildAjaxOptions($form) {
                var formEl = $form[0];
                var isMultipart = ($form.attr('enctype') || '').toLowerCase().indexOf('multipart/form-data') !== -1;
                var hasFileInput = $form.find('input[type="file"]').length > 0;
                var useFormData = isMultipart || hasFileInput;

                var options = {
                    url: $form.attr('action'),
                    type: ($form.attr('method') || 'POST').toUpperCase(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    dataType: 'json'
                };

                if (useFormData) {
                    options.data = new FormData(formEl);
                    options.processData = false;
                    options.contentType = false;
                } else {
                    options.data = $form.serialize();
                }

                return options;
            }

            // Intercept submit for opt-in AJAX forms
            $(document).on('submit', 'form.js-ajax-form', function (e) {
                e.preventDefault();

                var $form = $(this);
                clearErrors($form);
                setSubmitting($form, true);

                var ajaxOptions = buildAjaxOptions($form);

                $.ajax($.extend({}, ajaxOptions, {
                    success: function (response) {
                        setSubmitting($form, false);

                        if (response && response.success) {
                            // If this form is in a Bootstrap modal, hide it
                            var $modal = $form.closest('.modal');
                            if ($modal.length) {
                                // Bootstrap 4 (jQuery)
                                if ($modal.modal) {
                                    try { $modal.modal('hide'); } catch (e) {}
                                }

                                // Bootstrap 5
                                if (window.bootstrap && window.bootstrap.Modal && $modal[0]) {
                                    try {
                                        var instance = window.bootstrap.Modal.getInstance($modal[0]);
                                        if (instance) instance.hide();
                                    } catch (e) {}
                                }
                            }

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message || 'Saved successfully!',
                                    showConfirmButton: false,
                                    timer: 1200
                                }).then(function () {
                                    if (response.redirect) window.location.href = response.redirect;
                                    else window.location.reload();
                                });
                            } else {
                                if (response.redirect) window.location.href = response.redirect;
                                else window.location.reload();
                            }
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({ icon: 'error', title: 'Error', text: (response && response.message) ? response.message : 'Unexpected response.' });
                            }
                        }
                    },
                    error: function (xhr) {
                        setSubmitting($form, false);

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            showErrors($form, xhr.responseJSON.errors);
                            return;
                        }

                        var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Please try again later.';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon: 'error', title: 'Error', text: msg });
                        }
                    }
                }));
            });

            // Clear field error on typing
            $(document).on('input change', 'form.js-ajax-form input, form.js-ajax-form select, form.js-ajax-form textarea', function () {
                var $field = $(this);
                $field.removeClass('is-invalid');
                var name = $field.attr('name');
                if (name) {
                    var $error = $field.closest('form').find('#error-' + name);
                    if ($error.length) $error.text('').hide();
                }
            });
        })();
    </script>

    @yield('scripts')

    <script>
        function confirmAction(event, message = 'Are you sure you want to proceed?') {
            event.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>

</body>

</html>

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-result {
            padding-top: 4px;
            padding-bottom: 3px
        }

        .select2-result__avatar {
            float: left;
            width: 60px;
            margin-right: 10px
        }

        .select2-result__avatar img {
            width: 100%;
            height: auto;
            border-radius: 2px
        }

        .select2-result__meta {
            margin-left: 70px;
            margin-right: 10px
        }

        .select2-result__title {
            color: black;
            font-weight: 700;
            word-wrap: break-word;
            line-height: 1.1;
            margin-bottom: 4px
        }

        .select2-result__description {
            font-size: 13px;
            color: #777;
            margin-top: 4px
        }

        .select2-results__option--highlighted .select2-result__title {
            color: white
        }

        .select2-results__option--highlighted .select2-result__description {
            color: #c6dcef
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize the select2
            var multimediaSelect = $('.js-multimedia-data-ajax');
            var selectType = 0;
            if (multimediaSelect.attr('id') == 'cover_picture[]') {
                selectType = 1;
            }
            multimediaSelect.select2({
                ajax: {
                    url: "{{ route('multimedias.index') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: "{{ csrf_token() }}",
                            search: params.term, // search term
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, page) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for Multimedias',
                minimumInputLength: 1,
                templateResult: formatMultimedia,
                templateSelection: formatMultimediaSelectionWithImage,
                maximumSelectionLength: selectType
            });

            function formatMultimedia(multimedia) {
                if (multimedia.loading) {
                    return multimedia.title;
                }

                var $container = $(
                    "<div class='select2-result clearfix'>" +
                    "<div class='select2-result__avatar'><img src='" + "{{ url('/') }}" + "/" +
                    multimedia.url + "' /></div>" +
                    "<div class='select2-result__meta'>" +
                    "<div class='select2-result__title'></div>" +
                    "<div class='select2-result__description'></div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result__title").text(multimedia.title);
                $container.find(".select2-result__description").text(multimedia.foot);

                return $container;
            }

            function formatMultimediaSelection(multimedia) {
                // Important, the two options are needed.
                // The first for the ajax request and de second for the option html element
                return multimedia.title || multimedia.text;
            }

            function formatMultimediaSelectionWithImage(multimedia) {
                if (multimedia.url == null) {
                    //Get Text
                    var selected = multimediaSelect.select2("data");
                    var selectedOption = multimediaSelect.find("option[value=" + selected[selected.length - 1].id +
                        "]");
                    multimedia.url = selectedOption.attr('data-url');
                }

                var $container = $(
                    "<div class='select2-result clearfix'>" +
                    "<div class='select2-result__avatar'><img src='" + "{{ url('/') }}" + "/" +
                    multimedia.url + "' /></div>" +
                    "<div class='select2-result__meta'>" +
                    "<div class='select2-result__title'></div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result__title").text(multimedia.title || multimedia.text);

                return $container;

                // Important, the two options are needed.
                // The first for the ajax request and de second for the option html element
                //return multimedia.title || multimedia.text;
            }

            // Fetch the preselected item, and add to the control
            @if (isset($gallery) || isset($news))
                @if (isset($gallery))
                    var url = "{{ route('galleries.edit', $gallery->id) }}";
                @elseif (isset($news))
                    var url = "{{ route('news.edit', $news->id) }}";
                @endif
                $.ajax({
                    type: 'GET',
                    url: url,
                }).then(function(data) {
                    data.results.forEach(multimedia => {
                        // create the option and append to Select2
                        var option = new Option(multimedia.title, multimedia.id, true, true);
                        option.setAttribute('data-url', multimedia.url);
                        multimediaSelect.append(option).trigger('change');

                        // manually trigger the `select2:select` event
                        multimediaSelect.trigger({
                            type: 'select2:select',
                            params: {
                                data: multimedia
                            }
                        });
                    });
                });
            @endif
        });
    </script>
@endsection

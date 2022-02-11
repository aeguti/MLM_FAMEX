@push('script-lib')
    <script src="{{ asset($activeTemplateTrue.'frontend/js/jquery.inputLettering.js') }}"></script>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('#phoneInput').letteringInput({
                inputClass: 'letter',
            });
        })(jQuery);
    </script>
@endpush

@push('style')
<style>
    #phoneInput .phone {
        display: flex
    }
    #phoneInput .phone .letter{
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff
    }

    #phoneInput .phone .letter:first-child{
        border-radius: 5px 0 0 5px
    }

    #phoneInput .phone .letter:last-child{
        border-radius: 0 5px 5px 0
    }
</style>
@endpush

{strip}
    <div class="d-flex flex-column">
        <div class="f-1 margin-right pageContentBox">
            {include file='razdelsList'|getTpl:$tplPath}
        </div>
        <div class="f-1"></div>
    </div>
    <script>
        if ('struct' in window) {
            struct.initRazdels();
        } else {
            document.addEventListener("DOMContentLoaded", function (event) {
                struct.initRazdels();
            });
        }
    </script>
{/strip}
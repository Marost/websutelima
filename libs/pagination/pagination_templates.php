<?php
//this file is never included formally, for security reasons, leave the following PHP code alone
//NOTE THAT ALL PHP CODE IS IGNORED BY THE TEMPLATE COMPILER - KEEP IT STRICTLY HTML CODE. Refer to the docs for more information.
//THIS PHP CODE IS ONLY COMPILED AND EXECUTED WHEN DIRECTLY INITIALIZED

die();

/*
THE FOLLOWING VARIABLES ARE INTERPRETED BY THE TEMPLATE COMPILER, AND CAN BE USED
[location]      => Current URI
[current_page]  => Current active page
[nth_page]      => The nth page, ie, any page number displayed in pagination that isn't active
[previous_page] => Previous page from the current page, ie, current_page - 1
[next_page]     => Next page from the current page, ie, current_page + 1

*/
?>


<!--pagination_header-->
<div class="outer_pagination">
    <div class="pagination blue">
<!--pagination_header end-->

<!--selected-->
        <span class="selected">[nth_page]</span>
<!--selected end-->

<!--unselected-->
        <span><a href="[location][nth_page]" title="">[nth_page]</a></span>
<!--unselected end-->

<!--previous-->
        <span><a href="[location][previous_page]" title="">&laquo; Anterior</a></span>
<!--previous end-->

<!--next-->
        <span><a href="[location][next_page]" title="">Siguiente &raquo;</a></span>
<!--next end-->

<!--left_arrow_disabled-->
        <span class="disabled"><</span>
<!--left_arrow_disabled end-->

<!--right_arrow_disabled-->
        <span class="disabled">></span>
<!--right_arrow_disabled end-->

<!--left_arrow-->
        <span><a href="[location][previous_page]" title=""><</a></span>
<!--left_arrow end-->

<!--right_arrow-->
        <span><a href="[location][next_page]" title="">></a></span>
<!--right_arrow end-->

<!--jumpto_header-->
        <form name="jumping" method="get">
            <select name="page" id="jumpto" onChange="window.document.location=('[location]'+this.options[this.selectedIndex].value);">
                <option value="1" selected="selected">Page</option>
<!--jumpto_header end-->

<!--jumpto_body-->
                <option value="[nth_page]">[nth_page]</option>
<!--jumpto_body end-->

<!--jumpto_footer-->
            </select>
            <!-- If you wish to display a JS fallback, uncomment the button below -->
            <!--<input type="button" name="go" value="Jump">-->
        </form>
<!--jumpto_footer end-->

<!--pagination_footer-->
    </div>
</div>
<!--pagination_footer end-->

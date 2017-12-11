<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<{$business}>">
    <input type="hidden" name="item_name" value="<{$item_name}>">
    <input type="hidden" name="currency_code" value="<{$currency_code}>">
    <input type="hidden" name="amount" value="<{$amount}>">
    <input type="image" name="submit" src="<{$btn_submit_img.src}>" alt="<{$btn_submit_img.alt}>">
</form>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <{if $var_more}>
        <input type="hidden" name="cmd" value="_ext-enter">
        <input type="hidden" name="redirect_cmd" value="_xclick">
    <{elseif $cmd_cart}>
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <{foreach from=$list_item key="cart_item_offset" item="cart_item"}>
            <{foreach from=$cart_item key="cart_item_option_key" item="cart_item_option_val"}>
                <{* TODO: 4 debug *}>
                <input
                        type="hidden"
                        name="<{$cart_item_option.cart_item_option_key + '_' + ($cart_item_offset + 1)}>"
                        value="<{$cart_item_option_val}>"
                >
            <{/foreach}>
        <{/foreach}>
    <{else}>
        <input type="hidden" name="cmd" value="_xclick">
    <{/if}>

    <input type="hidden" name="business" value="<{$business}>">
    <input type="hidden" name="item_name" value="<{$item_name}>">
    <input type="hidden" name="currency_code" value="<{$currency_code}>">
    <input type="hidden" name="amount" value="<{$amount}>">

    <{* TODO: 4 debug *}>
    <{if isset($cn)}>
        <input type="hidden" name="cn" value="<{$cn}>">
    <{/if}>
    <{if isset($image_url)}>
        <input type="hidden" name="image_url" value="<{$image_url}>">
    <{/if}>

    <input type="image" name="submit" src="<{$btn_submit_img.src}>" alt="<{$btn_submit_img.alt}>">
</form>

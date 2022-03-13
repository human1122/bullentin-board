$(function() {
    // スレッド一覧の表示数変更
    $(document).on('change', '.js-per-page', function() {
        const val = $(this).val();
        if (isNumber(val)) {
            const url = new URL(window.location.href);
            window.location.href = url.protocol + '//' + url.host + '?page_num=' + val;
        }
    });
});

/**
 * 数値か判定
 * 
 * @param val 
 * @returns bool
 */
function isNumber(val) {
    const regex = new RegExp(/^[0-9]+$/);
    return regex.test(val);
}
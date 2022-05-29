jQuery.extend(jQuery.expr[':'], { 
    "starts-with-lowercase" : function(el, i, p, n) {
        return (el.textContent || el.innerText).toLowerCase().indexOf(p[3].toLowerCase()) === 0;
    }
});
<?php $p = $params['page']; ?>
$('input.search').on('change input paste keyup', function(){
    var value = $(this).val();
    if(value != ''){
        $('.<?php echo $p; ?>-table').children(".<?php echo $p; ?>-table-row").not('.title').css({'display': 'none'});
        var findings = $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row:has(p:starts-with-lowercase("' + value + '"))');

        if(findings.length == 0){
            findings = $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row:contains("' + value + '")');
        }

        findings.css({'display': 'flex'});
    } else {
        $('.<?php echo $p; ?>-table').children('.<?php echo $p; ?>-table-row').css({'display': 'flex'});
    }
});
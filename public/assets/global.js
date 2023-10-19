const Config = {
    tbl:$("#datatable"),
    prinVoucher: $("meta[name='prinVoucher']").attr("content"),
    printCheque: $("meta[name='printCheque']").attr("content"),
    loadToPrint:(url) =>{
        $("<iframe>")             // create a new iframe element
            .hide()               // make it invisible
            .attr("src", url)     // point the iframe to the page you want to print
            .appendTo("body");    // add iframe to the DOM to cause it to load the page
    },
    
}

$('input').on('click',function(){
    $(this).select();
})
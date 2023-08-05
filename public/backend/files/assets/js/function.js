let imgPreview = (input,img,width='200px',height='200px') => {
    $(input).change(function(e){
        e.preventDefault();
        $url = URL.createObjectURL(e.target.files[0]);
        $(img).attr('src',$url).css('width',width),css('height',height).css('margin','10px 0px');
    });
}

let logoutFormSubmit = (btn , form) => {

    $(btn).click(function(e){
        e.preventDefault();
        $(form).submit();
    });

}

$('.iconpicker').iconpicker({
        align: 'center', // Only in div tag
        arrowClass: 'btn-danger',
        arrowPrevIconClass: 'fas fa-angle-left',
        arrowNextIconClass: 'fas fa-angle-right',
        cols: 10,
        footer: true,
        header: true,
        icon: 'fas fa-bomb',
        iconset: 'fontawesome5',
        labelHeader: '{0} of {1} pages',
        labelFooter: '{0} - {1} of {2} icons',
        placement: 'bottom', // Only in button tag
        rows: 5,
        search: false,
        selectedClass: 'btn-success',
        unselectedClass: ''
})
$('.iconpicker').on('change', function(e) {
    $('.icon-value').val(e.icon)
})

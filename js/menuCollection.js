function changecolor(htmlId, id) {
    $('#'+htmlId+id).css('background', '#cad5f7');
    $('#'+htmlId+id).css('cursor', 'pointer');
}

function rowbackcolor(htmlId, id) {
    $('#'+htmlId+id).css('background', '#fff');
    $('#'+htmlId+id).css('cursor', 'auto');
}

function SelectedField(obj, id) {
    $("#"+obj).val(id);
    var novo = null;

    setTimeout(function () {
        $.ajax({ type: "GET", url: "/collections/"+obj+"/"+id,

            success: function (data) {
                for(i = 1; i<=Object.keys(data).length; i++){
                    if(data[i] != undefined) {
                        if(novo == null ){
                            novo = data[i];
                        } else {
                            var novo = novo + ' > ' + data[i];
                        }
                    }
                }
                $("#"+obj+"Show").val(novo);

            }
        });
        if(obj == 'file')
            $('#md-file').modal('hide');
    }, 100);

}

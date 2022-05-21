$("input[name='picture']").change(function () {
    console.log("masuk");
    if (this.files && this.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('.picture_preview').attr('src', event.target.result);
        };
        fileReader.readAsDataURL(this.files[0]);
    }
});
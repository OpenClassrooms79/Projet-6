function manageImage(inputId, imageId) {
    const input = document.getElementById(inputId);
    input.addEventListener('change', function () {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById(imageId).src = this.result;
        };
        reader.readAsDataURL(file);
    }, false);
}
/**
 * Remplace l'image d'ID inputId par le fichier choisi par le champ imageId (INPUT de type "file")
 * @param inputId
 * @param imageId
 */
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
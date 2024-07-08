$(document).ready(function() {
    $(".fav").on("click", function() {
        const akapit = $(this);
        $.post("changeFav.php", { idSwetra: akapit.data("sweter") }, function(data) {
            if (data.trim() == "sukces") {
                const isFilled = akapit.attr("src") === "obrazki/filled_heart.png";
                akapit.attr("src", isFilled ? "obrazki/empty_heart.png" : "obrazki/filled_heart.png");
            } else {
                console.error("Błąd: " + data);
            }
        });
    });
});

function allowOnlyNumbers(event) {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
    }
}
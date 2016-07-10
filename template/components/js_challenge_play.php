<script>

    var whatIsButton = document.getElementById("showWhatIs");
    var closeWhatIs = document.getElementById("whatIsClose");
    var whatIs = document.getElementById("whatIs");


    whatIsButton.onclick = function () {
        whatIs.style.display = 'block';
    };

    closeWhatIs.onclick = function () {
        whatIs.style.display = 'none';
    }


    hint.onclick = function () {
        if (!hintOpen && hintNumber < 1 && !timeUp && !questionAnswered) {
            hintNumber++;
            hintOpen = true;
            hintOverlay.style.display = 'block';
            $("#questionTimeDeduction").css("top", "-15%");
            $("#questionTimeDeduction").css("display", "block");
            $("#questionTimeDeduction").css("opacity", "1");
            $('#questionTimeDeduction').animate({
                opacity: 0,
                top: '-150%'
            }, 880, function () {
                $("#questionTimeDeduction").css("display", "none");
                $("#questionTimeDeduction").css("top", "-15%");
                $("#questionTimeDeduction").css("opacity", "1");
            });
            score -= 10;
            if (score < 0) {
                score = 0;
            }
            HintCounter();

            if (hintNumber >= 1) {
                imgHint.src = "img/img_hintDone.png";
            }


        }
    };

    function HintCounter() {
        if (hintCounter == hintTime) {
            hintOpen = false;
            hintCounter = 0;
            hintOverlay.style.display = 'none';
        }

        else {
            hintCounter++;
            timeoutMyOswego = setTimeout(HintCounter, 1200);
        }
    };









</script>
document.body.setScaledFont = function(f) {
      var s = this.offsetWidth, fs = s * f;
      this.style.fontSize = fs + '%';
      return this
    };

    document.body.setScaledFont(0.35);
window.onresize = function() {
    document.body.setScaledFont(0.35);
}
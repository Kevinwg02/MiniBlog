function calcHeight(value) {
    let numberOfLineBreaks = (value.match(/\n/g) || []).length;
    // min-height + lines x line-height + padding + border
    let newHeight = 40 + numberOfLineBreaks * 30 + 20 + 20;
    return newHeight;
  }
  
  let textarea = document.querySelector(".resize-ta");
  textarea.addEventListener("keyup", () => {
    textarea.style.height = calcHeight(textarea.value) + "px";
  });
const octavoCarrusel = document.querySelector(".carrusel8"),
  firstImgOctavoCarrusel = octavoCarrusel.querySelectorAll("img")[0],
  arrowIconsOctavoCarrusel = document.querySelectorAll(".wrapper8 i");

let isDragStartOctavoCarrusel = false,
  isDraggingOctavoCarrusel = false,
  prevPageXOctavoCarrusel,
  prevScrollLeftOctavoCarrusel,
  positionDiffOctavoCarrusel;

const showHideIconsOctavoCarrusel = () => {
  let scrollWidth = octavoCarrusel.scrollWidth - octavoCarrusel.clientWidth;
  arrowIconsOctavoCarrusel[0].style.display =
    octavoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsOctavoCarrusel[1].style.display =
    octavoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsOctavoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgOctavoCarrusel.clientWidth + 14;
    octavoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsOctavoCarrusel(), 60);
  });
});

const autoSlideOctavoCarrusel = () => {
  if (
    octavoCarrusel.scrollLeft -
      (octavoCarrusel.scrollWidth - octavoCarrusel.clientWidth) >
      -1 ||
    octavoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffOctavoCarrusel = Math.abs(positionDiffOctavoCarrusel);
  let firstImgWidth = firstImgOctavoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffOctavoCarrusel;

  if (octavoCarrusel.scrollLeft > prevScrollLeftOctavoCarrusel) {
    return (octavoCarrusel.scrollLeft +=
      positionDiffOctavoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffOctavoCarrusel);
  }

  octavoCarrusel.scrollLeft -=
    positionDiffOctavoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffOctavoCarrusel;
};

const dragStartOctavoCarrusel = (e) => {
  isDragStartOctavoCarrusel = true;
  prevPageXOctavoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftOctavoCarrusel = octavoCarrusel.scrollLeft;
};

const draggingOctavoCarrusel = (e) => {
  if (!isDragStartOctavoCarrusel) return;
  e.preventDefault();
  isDraggingOctavoCarrusel = true;
  octavoCarrusel.classList.add("dragging");
  positionDiffOctavoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXOctavoCarrusel;
  octavoCarrusel.scrollLeft = prevScrollLeftOctavoCarrusel - positionDiffOctavoCarrusel;
  showHideIconsOctavoCarrusel();
};

const dragStopOctavoCarrusel = () => {
  isDragStartOctavoCarrusel = false;
  octavoCarrusel.classList.remove("dragging");

  if (!isDraggingOctavoCarrusel) return;
  isDraggingOctavoCarrusel = false;
  autoSlideOctavoCarrusel();
};

octavoCarrusel.addEventListener("mousedown", dragStartOctavoCarrusel);
octavoCarrusel.addEventListener("touchstart", dragStartOctavoCarrusel);

document.addEventListener("mousemove", draggingOctavoCarrusel);
octavoCarrusel.addEventListener("touchmove", draggingOctavoCarrusel);

document.addEventListener("mouseup", dragStopOctavoCarrusel);
octavoCarrusel.addEventListener("touchend", dragStopOctavoCarrusel);

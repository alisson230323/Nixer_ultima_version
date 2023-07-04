const segundoCarrusel = document.querySelector(".carrusel2"),
  firstImgSegundoCarrusel = segundoCarrusel.querySelectorAll("img")[0],
  arrowIconsSegundoCarrusel = document.querySelectorAll(".wrapper2 i");

let isDragStartSegundoCarrusel = false,
  isDraggingSegundoCarrusel = false,
  prevPageXSegundoCarrusel,
  prevScrollLeftSegundoCarrusel,
  positionDiffSegundoCarrusel;

const showHideIconsSegundoCarrusel = () => {
  let scrollWidth = segundoCarrusel.scrollWidth - segundoCarrusel.clientWidth;
  arrowIconsSegundoCarrusel[0].style.display =
    segundoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsSegundoCarrusel[1].style.display =
    segundoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsSegundoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgSegundoCarrusel.clientWidth + 14;
    segundoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsSegundoCarrusel(), 60);
  });
});

const autoSlideSegundoCarrusel = () => {
  if (
    segundoCarrusel.scrollLeft -
      (segundoCarrusel.scrollWidth - segundoCarrusel.clientWidth) >
      -1 ||
    segundoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffSegundoCarrusel = Math.abs(positionDiffSegundoCarrusel);
  let firstImgWidth = firstImgSegundoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffSegundoCarrusel;

  if (segundoCarrusel.scrollLeft > prevScrollLeftSegundoCarrusel) {
    return (segundoCarrusel.scrollLeft +=
      positionDiffSegundoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffSegundoCarrusel);
  }

  segundoCarrusel.scrollLeft -=
    positionDiffSegundoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffSegundoCarrusel;
};

const dragStartSegundoCarrusel = (e) => {
  isDragStartSegundoCarrusel = true;
  prevPageXSegundoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftSegundoCarrusel = segundoCarrusel.scrollLeft;
};

const draggingSegundoCarrusel = (e) => {
  if (!isDragStartSegundoCarrusel) return;
  e.preventDefault();
  isDraggingSegundoCarrusel = true;
  segundoCarrusel.classList.add("dragging");
  positionDiffSegundoCarrusel =
    (e.pageX || e.touches[0].pageX) - prevPageXSegundoCarrusel;
  segundoCarrusel.scrollLeft =
    prevScrollLeftSegundoCarrusel - positionDiffSegundoCarrusel;
  showHideIconsSegundoCarrusel();
};

const dragStopSegundoCarrusel = () => {
  isDragStartSegundoCarrusel = false;
  segundoCarrusel.classList.remove("dragging");

  if (!isDraggingSegundoCarrusel) return;
  isDraggingSegundoCarrusel = false;
  autoSlideSegundoCarrusel();
};

segundoCarrusel.addEventListener("mousedown", dragStartSegundoCarrusel);
segundoCarrusel.addEventListener("touchstart", dragStartSegundoCarrusel);

document.addEventListener("mousemove", draggingSegundoCarrusel);
segundoCarrusel.addEventListener("touchmove", draggingSegundoCarrusel);

document.addEventListener("mouseup", dragStopSegundoCarrusel);
segundoCarrusel.addEventListener("touchend", dragStopSegundoCarrusel);
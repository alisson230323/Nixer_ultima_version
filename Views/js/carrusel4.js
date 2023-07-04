const cuartoCarrusel = document.querySelector(".carrusel4"),
  firstImgCuartoCarrusel = cuartoCarrusel.querySelectorAll("img")[0],
  arrowIconsCuartoCarrusel = document.querySelectorAll(".wrapper4 i");

let isDragStartCuartoCarrusel = false,
  isDraggingCuartoCarrusel = false,
  prevPageXCuartoCarrusel,
  prevScrollLeftCuartoCarrusel,
  positionDiffCuartoCarrusel;

const showHideIconsCuartoCarrusel = () => {
  let scrollWidth = cuartoCarrusel.scrollWidth - cuartoCarrusel.clientWidth;
  arrowIconsCuartoCarrusel[0].style.display =
    cuartoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsCuartoCarrusel[1].style.display =
    cuartoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsCuartoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgCuartoCarrusel.clientWidth + 14;
    cuartoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsCuartoCarrusel(), 60);
  });
});

const autoSlideCuartoCarrusel = () => {
  if (
    cuartoCarrusel.scrollLeft -
      (cuartoCarrusel.scrollWidth - cuartoCarrusel.clientWidth) >
      -1 ||
    cuartoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffCuartoCarrusel = Math.abs(positionDiffCuartoCarrusel);
  let firstImgWidth = firstImgCuartoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffCuartoCarrusel;

  if (cuartoCarrusel.scrollLeft > prevScrollLeftCuartoCarrusel) {
    return (cuartoCarrusel.scrollLeft +=
      positionDiffCuartoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffCuartoCarrusel);
  }

  cuartoCarrusel.scrollLeft -=
    positionDiffCuartoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffCuartoCarrusel;
};

const dragStartCuartoCarrusel = (e) => {
  isDragStartCuartoCarrusel = true;
  prevPageXCuartoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftCuartoCarrusel = cuartoCarrusel.scrollLeft;
};

const draggingCuartoCarrusel = (e) => {
  if (!isDragStartCuartoCarrusel) return;
  e.preventDefault();
  isDraggingCuartoCarrusel = true;
  cuartoCarrusel.classList.add("dragging");
  positionDiffCuartoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXCuartoCarrusel;
  cuartoCarrusel.scrollLeft = prevScrollLeftCuartoCarrusel - positionDiffCuartoCarrusel;
  showHideIconsCuartoCarrusel();
};

const dragStopCuartoCarrusel = () => {
  isDragStartCuartoCarrusel = false;
  cuartoCarrusel.classList.remove("dragging");

  if (!isDraggingCuartoCarrusel) return;
  isDraggingCuartoCarrusel = false;
  autoSlideCuartoCarrusel();
};

cuartoCarrusel.addEventListener("mousedown", dragStartCuartoCarrusel);
cuartoCarrusel.addEventListener("touchstart", dragStartCuartoCarrusel);

document.addEventListener("mousemove", draggingCuartoCarrusel);
cuartoCarrusel.addEventListener("touchmove", draggingCuartoCarrusel);

document.addEventListener("mouseup", dragStopCuartoCarrusel);
cuartoCarrusel.addEventListener("touchend", dragStopCuartoCarrusel);

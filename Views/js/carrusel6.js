const sextoCarrusel = document.querySelector(".carrusel6"),
  firstImgSextoCarrusel = sextoCarrusel.querySelectorAll("img")[0],
  arrowIconsSextoCarrusel = document.querySelectorAll(".wrapper6 i");

let isDragStartSextoCarrusel = false,
  isDraggingSextoCarrusel = false,
  prevPageXSextoCarrusel,
  prevScrollLeftSextoCarrusel,
  positionDiffSextoCarrusel;

const showHideIconsSextoCarrusel = () => {
  let scrollWidth = sextoCarrusel.scrollWidth - sextoCarrusel.clientWidth;
  arrowIconsSextoCarrusel[0].style.display =
    sextoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsSextoCarrusel[1].style.display =
    sextoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsSextoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgSextoCarrusel.clientWidth + 14;
    sextoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsSextoCarrusel(), 60);
  });
});

const autoSlideSextoCarrusel = () => {
  if (
    sextoCarrusel.scrollLeft -
      (sextoCarrusel.scrollWidth - sextoCarrusel.clientWidth) >
      -1 ||
    sextoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffSextoCarrusel = Math.abs(positionDiffSextoCarrusel);
  let firstImgWidth = firstImgSextoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffSextoCarrusel;

  if (sextoCarrusel.scrollLeft > prevScrollLeftSextoCarrusel) {
    return (sextoCarrusel.scrollLeft +=
      positionDiffSextoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffSextoCarrusel);
  }

  sextoCarrusel.scrollLeft -=
    positionDiffSextoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffSextoCarrusel;
};

const dragStartSextoCarrusel = (e) => {
  isDragStartSextoCarrusel = true;
  prevPageXSextoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftSextoCarrusel = sextoCarrusel.scrollLeft;
};

const draggingSextoCarrusel = (e) => {
  if (!isDragStartSextoCarrusel) return;
  e.preventDefault();
  isDraggingSextoCarrusel = true;
  sextoCarrusel.classList.add("dragging");
  positionDiffSextoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXSextoCarrusel;
  sextoCarrusel.scrollLeft = prevScrollLeftSextoCarrusel - positionDiffSextoCarrusel;
  showHideIconsSextoCarrusel();
};

const dragStopSextoCarrusel = () => {
  isDragStartSextoCarrusel = false;
  sextoCarrusel.classList.remove("dragging");

  if (!isDraggingSextoCarrusel) return;
  isDraggingSextoCarrusel = false;
  autoSlideSextoCarrusel();
};

sextoCarrusel.addEventListener("mousedown", dragStartSextoCarrusel);
sextoCarrusel.addEventListener("touchstart", dragStartSextoCarrusel);

document.addEventListener("mousemove", draggingSextoCarrusel);
sextoCarrusel.addEventListener("touchmove", draggingSextoCarrusel);

document.addEventListener("mouseup", dragStopSextoCarrusel);
sextoCarrusel.addEventListener("touchend", dragStopSextoCarrusel);

const septimoCarrusel = document.querySelector(".carrusel7"),
  firstImgSeptimoCarrusel = septimoCarrusel.querySelectorAll("img")[0],
  arrowIconsSeptimoCarrusel = document.querySelectorAll(".wrapper7 i");

let isDragStartSeptimoCarrusel = false,
  isDraggingSeptimoCarrusel = false,
  prevPageXSeptimoCarrusel,
  prevScrollLeftSeptimoCarrusel,
  positionDiffSeptimoCarrusel;

const showHideIconsSeptimoCarrusel = () => {
  let scrollWidth = septimoCarrusel.scrollWidth - septimoCarrusel.clientWidth;
  arrowIconsSeptimoCarrusel[0].style.display =
    septimoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsSeptimoCarrusel[1].style.display =
    septimoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsSeptimoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgSeptimoCarrusel.clientWidth + 14;
    septimoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsSeptimoCarrusel(), 60);
  });
});

const autoSlideSeptimoCarrusel = () => {
  if (
    septimoCarrusel.scrollLeft -
      (septimoCarrusel.scrollWidth - septimoCarrusel.clientWidth) >
      -1 ||
    septimoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffSeptimoCarrusel = Math.abs(positionDiffSeptimoCarrusel);
  let firstImgWidth = firstImgSeptimoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffSeptimoCarrusel;

  if (septimoCarrusel.scrollLeft > prevScrollLeftSeptimoCarrusel) {
    return (septimoCarrusel.scrollLeft +=
      positionDiffSeptimoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffSeptimoCarrusel);
  }

  septimoCarrusel.scrollLeft -=
    positionDiffSeptimoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffSeptimoCarrusel;
};

const dragStartSeptimoCarrusel = (e) => {
  isDragStartSeptimoCarrusel = true;
  prevPageXSeptimoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftSeptimoCarrusel = septimoCarrusel.scrollLeft;
};

const draggingSeptimoCarrusel = (e) => {
  if (!isDragStartSeptimoCarrusel) return;
  e.preventDefault();
  isDraggingSeptimoCarrusel = true;
  septimoCarrusel.classList.add("dragging");
  positionDiffSeptimoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXSeptimoCarrusel;
  septimoCarrusel.scrollLeft = prevScrollLeftSeptimoCarrusel - positionDiffSeptimoCarrusel;
  showHideIconsSeptimoCarrusel();
};

const dragStopSeptimoCarrusel = () => {
  isDragStartSeptimoCarrusel = false;
  septimoCarrusel.classList.remove("dragging");

  if (!isDraggingSeptimoCarrusel) return;
  isDraggingSeptimoCarrusel = false;
  autoSlideSeptimoCarrusel();
};

septimoCarrusel.addEventListener("mousedown", dragStartSeptimoCarrusel);
septimoCarrusel.addEventListener("touchstart", dragStartSeptimoCarrusel);

document.addEventListener("mousemove", draggingSeptimoCarrusel);
septimoCarrusel.addEventListener("touchmove", draggingSeptimoCarrusel);

document.addEventListener("mouseup", dragStopSeptimoCarrusel);
septimoCarrusel.addEventListener("touchend", dragStopSeptimoCarrusel);

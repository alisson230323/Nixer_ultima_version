const novenoCarrusel = document.querySelector(".carrusel9"),
  firstImgNovenoCarrusel = novenoCarrusel.querySelectorAll("img")[0],
  arrowIconsNovenoCarrusel = document.querySelectorAll(".wrapper9 i");

let isDragStartNovenoCarrusel = false,
  isDraggingNovenoCarrusel = false,
  prevPageXNovenoCarrusel,
  prevScrollLeftNovenoCarrusel,
  positionDiffNovenoCarrusel;

const showHideIconsNovenoCarrusel = () => {
  let scrollWidth = novenoCarrusel.scrollWidth - novenoCarrusel.clientWidth;
  arrowIconsNovenoCarrusel[0].style.display =
    novenoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsNovenoCarrusel[1].style.display =
    novenoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsNovenoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgNovenoCarrusel.clientWidth + 14;
    novenoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsNovenoCarrusel(), 60);
  });
});

const autoSlideNovenoCarrusel = () => {
  if (
    novenoCarrusel.scrollLeft -
      (novenoCarrusel.scrollWidth - novenoCarrusel.clientWidth) >
      -1 ||
    novenoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffNovenoCarrusel = Math.abs(positionDiffNovenoCarrusel);
  let firstImgWidth = firstImgNovenoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffNovenoCarrusel;

  if (novenoCarrusel.scrollLeft > prevScrollLeftNovenoCarrusel) {
    return (novenoCarrusel.scrollLeft +=
      positionDiffNovenoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffNovenoCarrusel);
  }

  novenoCarrusel.scrollLeft -=
    positionDiffNovenoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffNovenoCarrusel;
};

const dragStartNovenoCarrusel = (e) => {
  isDragStartNovenoCarrusel = true;
  prevPageXNovenoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftNovenoCarrusel = novenoCarrusel.scrollLeft;
};

const draggingNovenoCarrusel = (e) => {
  if (!isDragStartNovenoCarrusel) return;
  e.preventDefault();
  isDraggingNovenoCarrusel = true;
  novenoCarrusel.classList.add("dragging");
  positionDiffNovenoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXNovenoCarrusel;
  novenoCarrusel.scrollLeft = prevScrollLeftNovenoCarrusel - positionDiffNovenoCarrusel;
  showHideIconsNovenoCarrusel();
};

const dragStopNovenoCarrusel = () => {
  isDragStartNovenoCarrusel = false;
  novenoCarrusel.classList.remove("dragging");

  if (!isDraggingNovenoCarrusel) return;
  isDraggingNovenoCarrusel = false;
  autoSlideNovenoCarrusel();
};

novenoCarrusel.addEventListener("mousedown", dragStartNovenoCarrusel);
novenoCarrusel.addEventListener("touchstart", dragStartNovenoCarrusel);

document.addEventListener("mousemove", draggingNovenoCarrusel);
novenoCarrusel.addEventListener("touchmove", draggingNovenoCarrusel);

document.addEventListener("mouseup", dragStopNovenoCarrusel);
novenoCarrusel.addEventListener("touchend", dragStopNovenoCarrusel);

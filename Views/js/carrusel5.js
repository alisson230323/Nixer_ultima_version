const quintoCarrusel = document.querySelector(".carrusel5"),
  firstImgQuintoCarrusel = quintoCarrusel.querySelectorAll("img")[0],
  arrowIconsQuintoCarrusel = document.querySelectorAll(".wrapper5 i");

let isDragStartQuintoCarrusel = false,
  isDraggingQuintoCarrusel = false,
  prevPageXQuintoCarrusel,
  prevScrollLeftQuintoCarrusel,
  positionDiffQuintoCarrusel;

const showHideIconsQuintoCarrusel = () => {
  let scrollWidth = quintoCarrusel.scrollWidth - quintoCarrusel.clientWidth;
  arrowIconsQuintoCarrusel[0].style.display =
    quintoCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsQuintoCarrusel[1].style.display =
    quintoCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsQuintoCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgQuintoCarrusel.clientWidth + 14;
    quintoCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsQuintoCarrusel(), 60);
  });
});

const autoSlideQuintoCarrusel = () => {
  if (
    quintoCarrusel.scrollLeft -
      (quintoCarrusel.scrollWidth - quintoCarrusel.clientWidth) >
      -1 ||
    quintoCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffQuintoCarrusel = Math.abs(positionDiffQuintoCarrusel);
  let firstImgWidth = firstImgQuintoCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffQuintoCarrusel;

  if (quintoCarrusel.scrollLeft > prevScrollLeftQuintoCarrusel) {
    return (quintoCarrusel.scrollLeft +=
      positionDiffQuintoCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffQuintoCarrusel);
  }

  quintoCarrusel.scrollLeft -=
    positionDiffQuintoCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffQuintoCarrusel;
};

const dragStartQuintoCarrusel = (e) => {
  isDragStartQuintoCarrusel = true;
  prevPageXQuintoCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftQuintoCarrusel = quintoCarrusel.scrollLeft;
};

const draggingQuintoCarrusel = (e) => {
  if (!isDragStartQuintoCarrusel) return;
  e.preventDefault();
  isDraggingQuintoCarrusel = true;
  quintoCarrusel.classList.add("dragging");
  positionDiffQuintoCarrusel = (e.pageX || e.touches[0].pageX) - prevPageXQuintoCarrusel;
  quintoCarrusel.scrollLeft = prevScrollLeftQuintoCarrusel - positionDiffQuintoCarrusel;
  showHideIconsQuintoCarrusel();
};

const dragStopQuintoCarrusel = () => {
  isDragStartQuintoCarrusel = false;
  quintoCarrusel.classList.remove("dragging");

  if (!isDraggingQuintoCarrusel) return;
  isDraggingQuintoCarrusel = false;
  autoSlideQuintoCarrusel();
};

quintoCarrusel.addEventListener("mousedown", dragStartQuintoCarrusel);
quintoCarrusel.addEventListener("touchstart", dragStartQuintoCarrusel);

document.addEventListener("mousemove", draggingQuintoCarrusel);
quintoCarrusel.addEventListener("touchmove", draggingQuintoCarrusel);

document.addEventListener("mouseup", dragStopQuintoCarrusel);
quintoCarrusel.addEventListener("touchend", dragStopQuintoCarrusel);

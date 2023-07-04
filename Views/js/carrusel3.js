const tercerCarrusel = document.querySelector(".carrusel3"),
  firstImgTercerCarrusel = tercerCarrusel.querySelectorAll("img")[0],
  arrowIconsTercerCarrusel = document.querySelectorAll(".wrapper3 i");

let isDragStartTercerCarrusel = false,
  isDraggingTercerCarrusel = false,
  prevPageXTercerCarrusel,
  prevScrollLeftTercerCarrusel,
  positionDiffTercerCarrusel;

const showHideIconsTercerCarrusel = () => {
  let scrollWidth = tercerCarrusel.scrollWidth - tercerCarrusel.clientWidth;
  arrowIconsTercerCarrusel[0].style.display =
    tercerCarrusel.scrollLeft == 0 ? "none" : "block";
  arrowIconsTercerCarrusel[1].style.display =
    tercerCarrusel.scrollLeft == scrollWidth ? "none" : "block";
};

arrowIconsTercerCarrusel.forEach((icon) => {
  icon.addEventListener("click", () => {
    let firstImgWidth = firstImgTercerCarrusel.clientWidth + 14;
    tercerCarrusel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
    setTimeout(() => showHideIconsTercerCarrusel(), 60);
  });
});

const autoSlideTercerCarrusel = () => {
  if (
    tercerCarrusel.scrollLeft -
      (tercerCarrusel.scrollWidth - tercerCarrusel.clientWidth) >
      -1 ||
    tercerCarrusel.scrollLeft <= 0
  )
    return;

  positionDiffTercerCarrusel = Math.abs(positionDiffTercerCarrusel);
  let firstImgWidth = firstImgTercerCarrusel.clientWidth + 14;
  let valDifference = firstImgWidth - positionDiffTercerCarrusel;

  if (tercerCarrusel.scrollLeft > prevScrollLeftTercerCarrusel) {
    return (tercerCarrusel.scrollLeft +=
      positionDiffTercerCarrusel > firstImgWidth / 3
        ? valDifference
        : -positionDiffTercerCarrusel);
  }

  tercerCarrusel.scrollLeft -=
    positionDiffTercerCarrusel > firstImgWidth / 3
      ? valDifference
      : -positionDiffTercerCarrusel;
};

const dragStartTercerCarrusel = (e) => {
  isDragStartTercerCarrusel = true;
  prevPageXTercerCarrusel = e.pageX || e.touches[0].pageX;
  prevScrollLeftTercerCarrusel = tercerCarrusel.scrollLeft;
};

const draggingTercerCarrusel = (e) => {
  if (!isDragStartTercerCarrusel) return;
  e.preventDefault();
  isDraggingTercerCarrusel = true;
  tercerCarrusel.classList.add("dragging");
  positionDiffTercerCarrusel =
    (e.pageX || e.touches[0].pageX) - prevPageXTercerCarrusel;
  tercerCarrusel.scrollLeft =
    prevScrollLeftTercerCarrusel - positionDiffTercerCarrusel;
  showHideIconsTercerCarrusel();
};

const dragStopTercerCarrusel = () => {
  isDragStartTercerCarrusel = false;
  tercerCarrusel.classList.remove("dragging");

  if (!isDraggingTercerCarrusel) return;
  isDraggingTercerCarrusel = false;
  autoSlideTercerCarrusel();
};

tercerCarrusel.addEventListener("mousedown", dragStartTercerCarrusel);
tercerCarrusel.addEventListener("touchstart", dragStartTercerCarrusel);

document.addEventListener("mousemove", draggingTercerCarrusel);
tercerCarrusel.addEventListener("touchmove", draggingTercerCarrusel);

document.addEventListener("mouseup", dragStopTercerCarrusel);
tercerCarrusel.addEventListener("touchend", dragStopTercerCarrusel);

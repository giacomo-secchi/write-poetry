

const animateCSS = (element, animation, prefix = 'animate__') =>
// We create a Promise and return it
new Promise((resolve, reject) => {
  const animationName = `${prefix}${animation}`;
  // const node = document.querySelector(element);
  const node = element.target;

  node.classList.add(`${prefix}animated`, animationName);

  // When the animation ends, we clean the classes and resolve the Promise
  function handleAnimationEnd(event) {
    event.stopPropagation();
    node.classList.remove(`${prefix}animated`, animationName);
    resolve('Animation ended');
  }

  node.addEventListener('animationend', handleAnimationEnd, {once: true});
});

  function onChange(entries, observer) {
    for (entry of entries) {
      if (entry.isIntersecting) {

        animateCSS(entry, entry.target.dataset.animation);
        observer.unobserve(entry.target)
      }
    }
  }
  
let observer = new IntersectionObserver(onChange);

window.addEventListener(
  'load',
  function () {
      document.querySelectorAll('.animate__animated').forEach(
        function(currentValue) {
          observer.observe(currentValue);
        }
      );
  },
  false
);
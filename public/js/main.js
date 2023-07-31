(function(globalSope) {
  'use strict';

  /**
   * Including this file adds the `addDynamicEventListener` function to the global scope.
   *
   * The dynamic listener gets an extra `selector` parameter that only calls the callback
   * if the target element matches the selector.
   *
   * The listener has to be added to the container/root element and the selector must match
   * the elements that should trigger the event.
   *
   * Browser support: IE11+
   */

  /**
   * Returns a modified callback function that calls the
   * initial callback function only if the target element matches the given selector
   *
   * @param {string} selector
   * @param {function} callback
   */
  function getConditionalCallback(selector, callback) {
      return function(e) {
          if(e.target && e.target.matches(selector)) {
              e.delegatedTarget = e.target;
              callback.apply(this, arguments);
              return;
          }
          // Not clicked directly, check bubble path
          var path = event.path || (event.composedPath && event.composedPath());
          if(!path) return;
          for(var i = 0; i < path.length; ++i) {
              var el = path[i];
              if (el.matches(selector)) {
                  // Call callback for all elements on the path that match the selector
                  e.delegatedTarget = el;
                  callback.apply(this, arguments);
              }
              // We reached parent node, stop
              if (el === e.currentTarget) {
                  return;
              }
          }
      };
  }

  /**
   *
   *
   * @param {Element} rootElement The root element to add the linster too.
   * @param {string} eventType The event type to listen for.
   * @param {string} selector The selector that should match the dynamic elements.
   * @param {function} callback The function to call when an event occurs on the given selector.
   * @param {boolean|object} options Passed as the regular `options` parameter to the addEventListener function
   *                                 Set to `true` to use capture.
   *                                 Usually used as an object to add the listener as `passive`
   */
  globalSope.addDynamicEventListener = function (rootElement, eventType, selector, callback, options) {
      rootElement.addEventListener(eventType, getConditionalCallback(selector, callback), options);
  };
})(this);

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var elements = document.getElementsByClassName("myImg");
var modalImg = document.getElementById("img01");

function changeImg (e) {
  console.log('test')
  modal.style.display = "block";
  modalImg.src = e.target.dataset.img;
}

  addDynamicEventListener(document.body, 'click','.myImg', (e) => changeImg(e));



// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
if(span !=null){
span.onclick = function () {
  modal.style.display = "none";
}
}

// index Carousel (preview) //

// var defaultTransform = 0;
// function goNext() {
//     defaultTransform = defaultTransform - 398;
//     var slider = document.getElementById("slider");
//     if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
//     slider.style.transform = "translateX(" + defaultTransform + "px)";
// }
// let next = document.getElementById("next");
// if(next){
//     next.addEventListener("click", goNext);
// }
// function goPrev() {
//     var slider = document.getElementById("slider");
//     if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
//     else defaultTransform = defaultTransform + 398;
//     slider.style.transform = "translateX(" + defaultTransform + "px)";
// }
// let prev = document.getElementById("prev");
// if(prev){
//     prev.addEventListener("click", goPrev);
// }
/////////////////////////////
var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
  };
///////////////////

// let button = document.getElementById("button");
// if(button){
//     button.addEventListener("click", prompt);
// }




// let button1 = document.getElementById("button1");
// if(button1){
//     button1.addEventListener('click', function () {
//         var text = document.getElementById('prompt');
//         text.value += 'Black hawk ';
//     });
// }

// let button2 = document.getElementById("button2");
// if(button2){
//     button1.addEventListener('click', function () {
//         var text = document.getElementById('prompt');
//         text.value += 'Black hawk ';
//     });
// }

// let button3 = document.getElementById("button3");
// if(button3){
//     button1.addEventListener('click', function () {
//         var text = document.getElementById('prompt');
//         text.value += 'Black hawk ';
//     });
// }

document.getElementById("button1").addEventListener('click', function () {
    var text = document.getElementById('prompt');
    text.value += 'Realistic 3d render of a happy, furry, cute, round baby feather duster cat smiling with big eyes looking straight at you, Pixar style, 32k, full body shot with yellow background ';
});

// let button1 = document.getElementById("button1");
// if(button1){
//     button1.addEventListener("click", prompt);
// }

document.getElementById("button2").addEventListener('click', function () {
    var text = document.getElementById('prompt');
    text.value += 'Cute wolf cub sticker, Vector color, and line art illustration, crisp and clean vector line, flat colors, smooth gradients, gradient contour outline, vivid colors, HDR, 16K, in the style of die-cut stickers ';
});
document.getElementById("button3").addEventListener('click', function () {
    var text = document.getElementById('prompt');
    text.value += 'vectorized design of a cartoon monkey driving a motorcycle in the summer, detailed, vintage, playful, vivid color, photoshoot, Unreal Engine 5, Cinematic, Color Grading, portrait Photography, Ultra-Wide Angle, Depth of Field, hyper-detailed, beautifully color-coded ';
});



////////////////////////////////


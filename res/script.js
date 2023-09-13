window.current_page = 3

$(document).ready(function () {
    document.body.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    });
    
    document.body.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        endY = e.changedTouches[0].clientY;
        
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        
        if (Math.abs(deltaX) > Math.abs(deltaY)) {
            // Horizontal swipe detected
            if (deltaX > 0) {
            // Swipe right
            swipeRight();
            } else {
            // Swipe left
            swipeLeft();
            }
        }
    });
    
    function swipeRight() {
        // if (0 >= window.curren_page) {
        //     return
        // }
        $(`.${window.current_page}`).removeClass('flip')
        window.current_page ++
    }
      
    function swipeLeft() {
        // if (window.max_ <= window.curren_page) {
        //     return
        // }
        $(`.${window.current_page}`).addClass('flip')
        // $(`.${window.curren_page}`).css('display', 'none')
        window.current_page --
    }
});
  
  
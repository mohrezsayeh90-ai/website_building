<button type="button" id="back-to-top" style="display: none"
        class="fixed bottom-5 left-10 hover:text-blue-200 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 rounded-full
         hover:bg-gradient-to-br focus:ring-4 focus:outline-none w-10 h-10 z-50
        focus:ring-purple-300 dark:focus:ring-purple-800 font-medium text-sm shadow-sm text-center me-2 mb-2">
    <i class="fa fa-arrow-up"></i>
</button>
<script>
    let scrollElem =document.getElementsByClassName("my-vertical-scroll-div");
    scrollElem = scrollElem.length ===1 ? scrollElem[0] : scrollElem[1];
    let btn =document.getElementById('back-to-top');
   scrollElem.onscroll=function backToTop(){
            if(scrollElem.scrollTop > 30) btn.style.display="block";
            else btn.style.display="none";
        }
    btn.addEventListener('click',function (){
        this.style.display="none";
        scrollElem.scrollTop = 0;
    })
</script>
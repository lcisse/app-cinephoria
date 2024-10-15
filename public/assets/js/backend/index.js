document.addEventListener('DOMContentLoaded', function() { 
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');  

    const navLinks = document.querySelectorAll('#navAdmin .nav-link');

    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        
        const queryString = href.split('?')[1];  

        if (queryString) {  
            const linkParams = new URLSearchParams(queryString);
            const linkAction = linkParams.get('action'); 

            console.log(linkAction);  

            if (linkAction === action) {
                link.classList.add('active');  
            } else {
                link.classList.remove('active');  
            }
        }
    });
});

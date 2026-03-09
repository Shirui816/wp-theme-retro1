document.addEventListener('DOMContentLoaded', function() {
    
    const commentForm = document.getElementById('commentform');

    if (commentForm) {

        commentForm.setAttribute('novalidate', '');

        commentForm.addEventListener('submit', function(e) {

            clearWin98Errors();

            const authorInput = document.getElementById('author');
            const emailInput = document.getElementById('email');
            const commentInput = document.getElementById('comment');
            
            let firstError = null;


            if (commentInput && !commentInput.value.trim()) {
                firstError = { el: commentInput, msg: "DATA_ERROR: Message body cannot be empty." };
            }


            if (emailInput) {
                const email = emailInput.value.trim();
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    firstError = { el: emailInput, msg: "SYSTEM_ERROR: Email address required." };
                } else if (!re.test(email)) {
                    firstError = { el: emailInput, msg: "PROTOCOL_ERROR: Invalid email format." };
                }
            }


            if (authorInput && !authorInput.value.trim()) {
                firstError = { el: authorInput, msg: "USER_ERROR: Identification required." };
            }


            if (firstError) {
                e.preventDefault();
                showWin98Error(firstError.el, firstError.msg);
                firstError.el.focus();
                return false;
            }
        });


        commentForm.addEventListener('input', clearWin98Errors);
    }


    function showWin98Error(el, msg) {
        const tip = document.createElement('div');
        tip.className = 'win98-error-tip';
        tip.innerText = msg;
        document.body.appendChild(tip);


        const rect = el.getBoundingClientRect();
        tip.style.left = (rect.left + window.scrollX) + 'px';
        tip.style.top = (rect.bottom + window.scrollY + 5) + 'px';
    }

    function clearWin98Errors() {
        const tips = document.querySelectorAll('.win98-error-tip');
        tips.forEach(t => t.remove());
    }


    const yearToggles = document.querySelectorAll('.archive-year-toggle');
    yearToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const year = this.dataset.year;
            const monthList = document.getElementById('archive-year-' + year);
            if (monthList.style.display === 'none' || monthList.style.display === '') {
                monthList.style.display = 'block';
                this.textContent = '[-] ' + year;
            } else {
                monthList.style.display = 'none';
                this.textContent = '[+] ' + year;
            }
        });
    });


    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('comment-reply-link')) {
            let commentParent = e.target.closest('.comment-body');
            let authorName = "UNKNOWN";
            if(commentParent) {
                let authorElem = commentParent.querySelector('.fn');
                if(authorElem) authorName = authorElem.textContent.trim();
            }

            setTimeout(function() {
                let textArea = document.getElementById('comment');
                let label = document.querySelector('label[for="comment"]');
                if (textArea) {
                    textArea.placeholder = ">> ESTABLISHING LINK WITH [ " + authorName + " ]...\n>> ENTER MESSAGE HERE_";
                    textArea.focus();
                }
                if (label) {
                    label.textContent = "REPLYING_TO: " + authorName;
                    label.style.backgroundColor = "#000";
                    label.style.color = "#fff";
                    label.style.padding = "2px 5px";
                }
            }, 100);
        }
    });
    
    const cancelReply = document.getElementById('cancel-comment-reply-link');
    if(cancelReply){
        cancelReply.addEventListener('click', function(){
             let textArea = document.getElementById('comment');
             let label = document.querySelector('label[for="comment"]');
             if(textArea) textArea.placeholder = "";
             if(label) {
                 label.textContent = "DATA_INPUT:";
                 label.style.background = "transparent";
                 label.style.color = "inherit";
                 label.style.padding = "0";
             }
        });
    }
});

const forms = document.querySelectorAll('#form-1-js');

forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = this.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const postId = this.querySelector('#post-id-1-js').value;
        const count = this.querySelector('#count-1-js');

        fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            method: 'post',
            body: JSON.stringify({
                id: postId
            })
        }).then(response => {
            response.json().then(data => {
                count.innerHTML = data.count;
            })
        }).catch(error => {
            console.log(error)
        });

    });
});
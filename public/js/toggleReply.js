$(document).ready(() => {
    console.log("Hello World");
    $('.reply-btn').on('click' , (e) => {
        e.preventDefault();

        // $('#reply-form').toggleClass('hidden').toggleClass('');
        var $link = e.currentTarget;
        $('[data-reply-'+e.currentTarget.dataset.comment+']').toggleClass('hidden').toggleClass('');
        // console.log($link.dataset.comment)
        // $link.toggleClass('hidden').toggleClass('');
    });

    $('#submit').submit((e) => {
        e.preventDefault();
        console.log("This is working");

        var $link = $(e.currentTarget);
        $.ajax({
            method: 'GET',
            url: $link.attr('href')
        }).done(data => {
            console.log()
        })
    })

    // $('.like-article').on('click', (e) => {
    //     e.preventDefault();


    //     let $link = $(e.currentTarget);
    //     // $link.toggleClass('bg-askio-gray').toggleClass('bg-askio-blue');
    //     // console.log("You clicked me");

    //     $.ajax({
    //         method: 'POST', 
    //         url: $link.attr('href')
    //     }).done(data => {
    //         $('#like-count').html(data.likes);
    //     })
    // })
})
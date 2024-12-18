// Interactivité des questions
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        question.classList.toggle('open');
        answer.style.display = answer.style.display === "block" ? "none" : "block";
    });
});

// Fonctionnalité de recherche
const searchInput = document.getElementById('search');
searchInput.addEventListener('input', function () {
    const query = searchInput.value.toLowerCase();
    document.querySelectorAll('.faq-item').forEach(item => {
        const questionText = item.querySelector('.faq-question').innerText.toLowerCase();
        item.style.display = questionText.includes(query) ? 'block' : 'none';
    });
});

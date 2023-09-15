const cardTitleElements = document.querySelectorAll('.bookParagraph');
const maxCharacters = 10; 

cardTitleElements.forEach(cardTitleElement => {
if (cardTitleElement.textContent.length > maxCharacters) {
const truncatedText = cardTitleElement.textContent.substring(0, maxCharacters) + '...';
cardTitleElement.textContent = truncatedText;
}
});

console.log("hello world");
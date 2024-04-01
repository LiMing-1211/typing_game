document.getElementById('startBtn').addEventListener('click', startGame);

function startGame() {
    document.getElementById('startBtn').style.display = 'none';
    document.getElementById('gameArea').style.display = 'block';
    getNextSentence();
}

function getNextSentence() {
    fetch('database.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('sentence').textContent = data.sentence;
        });
}

document.getElementById('inputSentence').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        checkAnswer();
    }
});

function checkAnswer() {
    let input = document.getElementById('inputSentence').value.trim();
    let sentence = document.getElementById('sentence').textContent.trim();
    if (input === sentence) {
        document.getElementById('result').textContent = '정답입니다!';
        setTimeout(getNextSentence, 3000);
    } else {
        document.getElementById('result').textContent = '오답입니다...';
        getNextSentence();
    }
    document.getElementById('inputSentence').value = '';
}

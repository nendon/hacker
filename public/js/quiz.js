// JavaScript Document
$(document).ready(function(){
  "use strict";
  
  var questions = [{
    question: "Carilah berapa nilai rata-rata umur dari para penonton bioskop di tahun 2019 menggunakan Python Jupyternetbook (Download di File Praktek file bioskop_dataset.csv):",
    choices: ['24', '28', '30', '45'],
    correctAnswer: 1
  }, {
    question: "Yang manakah yang dibawah ini <b>BUKAN</b> termasuk pengertian dari Mean :",
    choices: ["Mean adalah teknik yang digunakan untuk mencari nilai rata-rata dari serangkaian data.", "Mean = nilai2 dari sekumpulan data/banyaknya data", "Mean bertujuan untuk mencari nilai terbanyak yang muncul dari serangkaian data.", "Mean = nilaidarisekumpulandata.mean()"],
    correctAnswer: 1
  }
  ];
  
  var questionCounter = 0; //Tracks question number
  var selections = []; //Array containing user choices
  var quiz = $('.content'); //Quiz div object
  
  // Display initial question
  displayNext();
  
  // Click handler for the 'next' button
  $('#next').on('click', function (e) {
    e.preventDefault();
    
    // Suspend click listener during fade animation
    if(quiz.is(':animated')) {        
      return false;
    }
    choose();
    
    // If no user selection, progress is stopped
    if (isNaN(selections[questionCounter])) {
      $('#warning').text('Pilih salah satu jawaban!');
    } else {
      questionCounter++;
      displayNext();
	    $('#warning').text('');
    }
  });
  
  // Click handler for the 'prev' button
  $('#prev').on('click', function (e) {
    e.preventDefault();
    
    if(quiz.is(':animated')) {
      return false;
    }
    choose();
    questionCounter--;
    displayNext();
  });
  
  // Click handler for the 'Start Over' button
  $('#start').on('click', function (e) {
    e.preventDefault();
    
    if(quiz.is(':animated')) {
      return false;
    }
    questionCounter = 0;
    selections = [];
    displayNext();
    $('#next').removeAttr('disabled');
    $('#start').hide();
  });
  
  // Creates and returns the div that contains the questions and 
  // the answer selections
  function createQuestionElement(index) {
    var qElement = $('<div>', {
      id: 'question'
    });
    $('#progress-count').css("width", 100 / ( questions.length / (index+1) )+"%")
    $('#question-count').text("Pertanyaan "+(index+1)+"/"+questions.length)
    // var header = $('<h2>Question ' + (index + 1) + ':</h2>');
    // qElement.append(header);
    
    var question = $('<p>').append(questions[index].question);
    qElement.append(question);
    
    var radioButtons = createRadios(index);
    qElement.append(radioButtons);

    // this is new
    var warningText = $('<p id="warning">');
    qElement.append(warningText);
    
    return qElement;

  }
  
  // Creates a list of the answer choices as radio inputs
  function createRadios(index) {
    var radioList = $('<ul>');
    var item;
    var input = '';
    for (var i = 0; i < questions[index].choices.length; i++) {
      item = $('<li>');
      input = '<input type="radio" name="answer" value=' + i + ' id="question-'+i+'"  />';
      input += '<label for="question-'+i+'">'+questions[index].choices[i]+'</label>';
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }
  
  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter] = +$('input[name="answer"]:checked').val();
  }
  
  // Displays next requested element
  function displayNext() {
    // alert(questions.length);
    quiz.fadeOut(function() {
      $('#question').remove();
      
      if(questionCounter <= questions.length){
        var nextQuestion = createQuestionElement(questionCounter);
        quiz.append(nextQuestion).fadeIn();
        if (!(isNaN(selections[questionCounter]))) {
          $('input[value='+selections[questionCounter]+']').prop('checked', true);
        }
        $('#next').removeAttr('disabled');
        
        // Controls display of 'prev' button
        if (questionCounter == questions.length-1){
          $('#submit').show();
          $('#next').attr('disabled','disabled');
          $('#prev').removeAttr('disabled');
        }else if(questionCounter === 1){
          $('#submit').hide();
          $('#prev').removeAttr('disabled');
          $('#next').removeAttr('disabled');
        } else if(questionCounter === 0){
          $('#submit').hide();
          $('#prev').attr('disabled','disabled');
          $('#next').show();
        }
      }
    });
  }

$("#submit").click(function(){
  choose();
  // If no user selection, progress is stopped
  if (isNaN(selections[questionCounter])) {
    $('#warning').text('Pilih salah satu jawaban!');
  } else {
    /* Show Score 
    $('#question').remove();
    var scoreElem = displayScore();
    quiz.append(scoreElem).fadeIn();
    $('#start').show();
    $(this).hide();
    $('#next').hide();
    $('#prev').hide();
    */

    // Redirect 
    window.location.href = "review"
  }
})
  
  // Computes score and returns a paragraph element to be displayed
  function displayScore() {
    var text;
    var score = $('<h3>',{id: 'question'});
    var ques = $('<p>');
    
    text= "";
    var numCorrect = 0;
    for (var i = 0; i < selections.length; i++) {
      if (selections[i] === questions[i].correctAnswer) {
        numCorrect++;
        text += "Betul "+i+"\n";
      }else{
        text += "Salah "+i+"\n";
      }
    }
    
    console.log(text);
	  // Calculate score and display relevant message
	  var percentage = numCorrect / questions.length;
    if (percentage >= 0.9){
        score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Benar');
    }
    
    else if (percentage >= 0.5){
        score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Salah');
    }

    else {
        score.append(numCorrect + ' / ' + questions.length + ' Pertanyaan Salah');
    }

    return score;
  }
});
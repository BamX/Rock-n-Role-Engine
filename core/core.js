$(document).ready(function(){
    $('button, input:submit, input:reset').button();
    $('button, input:submit, input:reset').click(function() {
        $(this).removeClass('ui-state-focus'); // ��� �����-�� ��� ���, ��� ����� ����� ������� �� ��������... 
    });
})
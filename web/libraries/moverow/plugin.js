CKEDITOR.on( 'instanceReady', function( ev ) {
    var editor = ev.editor;
    bindMoveRowEvents(editor);

    var jsRegisterer = function() { bindMoveRowEvents(editor) };

    editor.on('mode', function() { if (editor.mode == 'wysiwyg') jsRegisterer() });
    editor.on('setData', jsRegisterer);
    
} );

function bindMoveRowEvents(editor) {
    var table_moverow_up = editor.getCommand('moverow_up');
    var table_moverow_down = editor.getCommand('moverow_down');

    editor.on('insertElement', function (insert_ev) {
        var element = insert_ev.data.$;

        if (element.tagName.toUpperCase() == 'TABLE') {
            table_moverow_up.enable();
            table_moverow_down.enable();
        }
    });

    editor.on('afterCommandExec', function (ac_ev) {
        var command_name = ac_ev.data.name;
        
        if (command_name === 'tableDelete') {
            table_moverow_up.disable();
            table_moverow_down.disable();
        }

    });

    var events = ['click', 'focus', 'keyup'];

    events.forEach(function(event) {
        editor.editable().on(event, function (e) {
            var element = find_element(editor.getSelection().getStartElement(), "table");
                
            if ("table" === element.getName()) {
                table_moverow_up.enable();
                table_moverow_down.enable();
    
            } else {
                table_moverow_up.disable();
                table_moverow_down.disable();
            }
    
        });
    });
}

CKEDITOR.plugins.add( 'moverow', {
    icons: 'moverow_up,moverow_down',
    init: function( editor ) {
        editor.addCommand( 'moverow_up', {
            exec: function( editor ) {
                var oldRanges = editor.getSelection().getRanges();
                var oldRange = oldRanges[oldRanges.length - 1];
                // var newRange = editor.createRange();

                // newRange.setStart(oldRange.startContainer, oldRange.startOffset);
                // newRange.setEnd(oldRange.endContainer, oldRange.endOffset);

                var row = editor.getSelection().getStartElement().getAscendant('tr');                
                
                if (null !== row.getPrevious()) {
                    row.insertBefore(row.getPrevious());

                    // editor.getSelection().selectRanges([ newRange ]);
                    editor.getSelection().selectRanges([ oldRange ]);
                }
                
            }
        });

        editor.addCommand( 'moverow_down', {
            exec: function( editor ) {
                var oldRanges = editor.getSelection().getRanges();
                
                var oldRange = oldRanges[oldRanges.length - 1];
                // var newRange = editor.createRange();

                // newRange.setStart(oldRange.startContainer, oldRange.startOffset);
                // newRange.setEnd(oldRange.endContainer, oldRange.endOffset);

                var row = editor.getSelection().getStartElement().getAscendant('tr');   

                if (null !== row.getNext()) {
                    row.insertAfter(row.getNext());

                    // editor.getSelection().selectRanges([ newRange ]);
                    editor.getSelection().selectRanges([ oldRange ]);
                } 
                
            }
        });

        editor.ui.addButton( 'moverow_up', {
            label: 'Move Row Up',
            command: 'moverow_up',
            toolbar: 'table'
        });

        editor.ui.addButton( 'moverow_down', {
            label: 'Move Row Down',
            command: 'moverow_down',
            toolbar: 'table'
        });
    }
});

function find_element(element, element_name) {
    if (null !== element && element_name !== element.getName() && "body" !== element.getName()) {
        while (element_name !== element.getName()) {
            element = element.getParent();

            if (element_name === element.getName() || "body" === element.getName()) {
                break;

            } 
        }

    } 

    return element;
}
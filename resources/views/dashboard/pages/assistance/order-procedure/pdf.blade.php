    <div id="entryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title"><strong>Solicitar Procedimiento,</strong> {!! $entry->diary->patient->doc_type_doc !!} - {!! $entry->diary->patient->name !!} </h3>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tipo de procedimientos</label>
                            <div class="col-md-9">
                                <p id="modal_procedure_type"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Procedimientos</label>
                            <div class="col-md-9">
                                <p id="modal_procedure"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


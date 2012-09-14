<?php
$this->pageTitle= Helpers::buildPageTitle("New IS Case");

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/newcase.css');

if($form->submitted('saveCase') && $form->validate())
{
    $this->beginWidget('INotificationWidget',array(
        'notId'=>'registeredMsg',
        'title'=>'IS Case Saved.',
        'init_display'=>true));
    ?>
    The submited case will now appear in the public repository.
    <?php
    $this->endWidget();

}
else
{
    $this->beginWidget('IBoxWidget',array(
    'boxId'=>'newCaseBox',
    'title'=>'New I.S. Case',
    'color'=>IBoxWidget::BLUE_IBOX,
    'closable'=>  false));
    ?>
    <br/>
    <div class="case-form"><?php echo $form; ?></div>

    <div class="instructions">
        <h3>Filling Instructions</h3>
        <p>
            <em class="bold">Title</em> – should contain at least the material and/or industrial activities involved.
        </p>
        <p>
            <em class="bold">Symbiosis type</em> – indicates the way by which the symbiosis is taking place, either:
            <ol>
                <li><em>Waste exchange</em> - Material exchanges on a trade-by-trade basis rather than continuously. They feature exchange of materials rather than of water or energy.</li>
                <li><em>Intra-facility</em> - Material exchanges occuring primarily inside the boundaries of one organization rather than with a collection of outside parties.</li>
                <li><em>Eco-industrial park</em> - Exchanges occuring primarily within the defined area of an industrial park or industrial estate. Businesses are contiguously located and can exchange energy, water or materials and can go further to share information and services.</li>
                <li><em>Local</em> - Exchanges occuring between businesses that are not adjacent to one another but rather are located within a small geographic area. (e.g. Kalundborg symbiosis, companies located within a few-mile radius)</li>
                <li><em>Regional</em> - Exchanges depending on virtual linkages (e.g. regional economic community) rather than colocation. (e.g. network of scrap metal dealers, auto recyclers)</li>
                <li><em>Mutualization</em> - Indicates a particular form of symbiosis where there is a pooling of resources or services among several businesses. (e.g. transport sharing, shared cooling system)<br/><br/></li>
            </ol>
        </p>
        <p>
            <em class="bold">Practice description</em> – should include specific details about the material or resource involved and how the input and/or output flows are organised.
        </p>
        <p>
            <em class="bold">Impacts</em> – should describe (for each kind) what are the positive impacts of the symbiosis once it is setup.
        </p>
        <p>
            <em class="bold">Contingencies</em> – should describe what are the possible risks involved in practicing the described symbiosis.
        </p>
    </div>

    <?php
    $this->endWidget();
}
?>
<br/>
<br/>
<br/>
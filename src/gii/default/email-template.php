<?php
/**
 * View file for gii generator.
 *
 * @var \ymaker\email\templates\gii\Generator $generator
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.1
 */

$className = $generator->migrationName;
echo "<?php\n";
?>
use yii\db\Migration;
use ymaker\email\templates\models\entities\EmailTemplate;

/**
 * Creates email template
 */
class <?= $className ?> extends Migration
{
    /**
     * @var string Migration table name.
     */
    public $tableName = '{{%email_template}}';
    /**
     * @var string Migration table name.
     */
    public $translationTableName = '{{%email_template_translation}}';


    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert($this->tableName, [
            'key' => '<?= $generator->key ?>',
        ]);

        $templateId = EmailTemplate::find()
            ->select('id')
            ->where(['key' => '<?= $generator->key ?>'])
            ->scalar();

        $this->insert($this->translationTableName, [
            'templateId'    => $templateId,
            'language'      => Yii::$app->language,
            'subject'       => '<?= $generator->subject ?>',
            'body'          => '<?= $generator->body ?>',
            'hint'          => '<?= $generator->hint ?>',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete($this->tableName, '[[key]] = :key', [
            ':key' => '<?= $generator->key ?>',
        ]);
    }
}

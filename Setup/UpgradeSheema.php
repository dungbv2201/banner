<?php

namespace Dungbv\Banner\Setup;


use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;


class UpgradeSheema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable("banner");
        $conn      = $installer->getConnection();
        if (!$conn->isTableExists($tableName)) {
            try {
                $table = $conn->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        ['identity' => true, 'primary' => true, 'nullable' => false, 'unsigned' => true]
                    )
                    ->addColumn(
                        'title',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable' => true]
                    )
                    ->addColumn(
                        'content',
                        Table::TYPE_TEXT,
                        500,
                        ['nullable' => true]
                    )
                    ->addColumn(
                        'link',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable' => true]
                    )
                    ->addColumn(
                        'image',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable' => false]
                    )
                    ->addColumn(
                        'status',
                        Table::TYPE_BOOLEAN,
                        null,
                        ['default' => 0],
                        '1 is active, 0 no active'
                    )
                    ->addColumn(
                        'sort_order',
                        Table::TYPE_SMALLINT,
                        null,
                        ['nullable' => true, 'default' => 0]
                    )
                    ->setOption('charset', 'utf8');
                $conn->createTable($table);
            } catch (\Zend_Db_Exception $e) {
                return $e->getMessage();
            }
        } else {
            $fullTextIndex = [
                'title', 'content'
            ];
            $setup->getConnection()->addIndex(
                $tableName,
                $setup->getIdxName($tableName, $fullTextIndex, AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIndex,
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();

    }
}
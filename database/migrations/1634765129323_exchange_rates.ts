import BaseSchema from '@ioc:Adonis/Lucid/Schema'

export default class ExchangeRates extends BaseSchema {
  protected tableName = 'exchange_rates'

  public async up () {
    this.schema.createTable(this.tableName, (table) => {
      table.increments('id')
      table
        .integer('submission_id')
        .unsigned()
        .references('submissions.id')
        .onDelete('CASCADE')
      table.float('hong_kong_dollar')
      /**
       * Uses timestamptz for PostgreSQL and DATETIME2 for MSSQL
       */
      table.timestamp('created_at', { useTz: true })
      table.timestamp('updated_at', { useTz: true })
    })
  }

  public async down () {
    this.schema.dropTable(this.tableName)
  }
}

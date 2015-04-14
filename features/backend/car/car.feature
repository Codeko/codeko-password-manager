@backend
Feature: Check the car admin module

  Scenario: Check comment admin pages when not connected
    When I go to "admin/sonata/demo/car/list"
    Then the response status code should be 200
    And I should see "Authentication"

  Scenario: Check car admin pages when connected
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    Then I should see "Filters"

  Scenario: Add a new car with some errors
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/create?subclass=renault&uniqid=f155592a220e"
    And I press "Create"
    Then I should see "An error has occurred during the creation of item \"Renault\"."

  Scenario: Add a new car
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/create?subclass=renault&uniqid=f155592a220e"
    And I fill in "Name" with "toto"
    And I fill in "f155592a220e_inspections_0_date" with "2013-01-01"
    And I press "Create"
    Then I should see "Item \"Renault\" has been successfully created."

  Scenario: Edit a car
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I follow "toto"
    And I press "Update"
    Then I should see "Item \"Renault\" has been successfully updated."

  Scenario: Filter cars
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I fill in "filter_name_value" with "toto"
    And I press "Filter"
    Then I should see "name"

  Scenario: Export JSON data
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I follow "JSON"
    Then the response status code should be 200

  Scenario: Export CSV data
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I follow "CSV"
    Then the response status code should be 200

  Scenario: Export XML data
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I follow "XML"
    Then the response status code should be 200

  Scenario: Export XLS data
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I follow "XLS"
    Then the response status code should be 200

  Scenario: Delete a car
    When I am connected with "admin" and "admin" on "admin/sonata/demo/car/list"
    And I fill in "filter_name_value" with "toto"
    And I press "Filter"
    And I follow "toto"
    And I follow link "Delete" with class "btn btn-danger"
    And I press "Yes, delete"
    Then I should see "Item \"Renault\" has been deleted successfully."

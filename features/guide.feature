Feature: Guide index
  In order to visit the index
  As a web user
  I need to be able to open the page

  @javascript
  Scenario: Visiting guide index
    And I am on "/guide"
    Then I should see "Guide"
    
  Scenario: Visiting guide index
    And I am on "/guide"
    Then I should see "Guide"
    And the response status code should be 200
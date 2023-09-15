// Load the necessary Drupal core files.
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\DependencyInjection\ContainerBuilder;

// Define the function to get the node count.
function getArticleNodeCount() {
  // Get the entity query service.
  $entity_query = \Drupal::entityQuery('node');

  // Add a condition to filter by content type.
  $entity_query->condition('type', 'article');

  // Get the count of nodes that match the condition.
  $count = $entity_query->count()->execute();

  return $count;
}

// Example usage:
$articleCount = getArticleNodeCount();
print('Total number of Article nodes: ' . $articleCount);


// Using the following procedure queries to avoid the SQLInjection attacks
$username = $_POST['username'];
$query = "SELECT * FROM {users} WHERE name = :username";
$result = db_query($query, [':username' => $username]);

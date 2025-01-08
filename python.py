import pandas as pd
import sqlite3

# Load data
def getDf(path):
    df = pd.read_csv(path)
    df = df.drop(['Unnamed: 0'], axis=1)
    return df

train_df_URL = "https://raw.githubusercontent.com/dataafriquehub/donnee_vente/refs/heads/main/submission.csv"
train_df = getDf(train_df_URL)

# Perform the grouping and aggregations using mode for 'stock_disponible'
grouped = train_df.groupby('id_produit').agg(
    prix_unitaire_mean=('prix_unitaire', 'mean'),
    stock_disponible_mode=('stock_disponible', lambda x: x.mode()[0]),  # Get mode for stock_disponible
    marque_mode=('marque', lambda x: x.mode()[0]),
    categorie_mode=('categorie', lambda x: x.mode()[0]),
    promotion = ('promotion', lambda x: x.mode()[0]),
).reset_index()

# Debugging: Check if grouped data contains rows
print(f"Number of rows in grouped data: {len(grouped)}")

# Path to SQLite database file
sqlite_db_path = 'C:/Users/hp/Desktop/AdminDashboard/database/database.sqlite'

# Connect to SQLite database
try:
    conn = sqlite3.connect(sqlite_db_path)
    cursor = conn.cursor()
    print("Connection to SQLite DB successful")
except sqlite3.Error as e:
    print(f"SQLite error: {e}")

# Create table if not exists (matching Laravel's migration structure)
cursor.execute('''
CREATE TABLE IF NOT EXISTS products (
    id TEXT PRIMARY KEY,
    categorie TEXT,
    marque TEXT,
    prix_unitaire DECIMAL(8, 2),
    promotion BOOLEAN DEFAULT FALSE,
    stock_disponible INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
)
''')

# Insert data into the table
for index, row in grouped.iterrows():
    print(f"Inserting: {row['id_produit']}, {row['prix_unitaire_mean']}, {row['stock_disponible_mode']}, {row['marque_mode']}, {row['categorie_mode']}, {row['promotion']}")
    try:
        cursor.execute('''
        INSERT OR REPLACE INTO products 
        (id, categorie, marque, prix_unitaire, promotion, stock_disponible, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
        ''', (row['id_produit'], row['categorie_mode'], row['marque_mode'], row['prix_unitaire_mean'], row['promotion'], row['stock_disponible_mode']))
    except sqlite3.Error as e:
        print(f"SQLite error during insertion: {e}")

# Commit and close the connection
conn.commit()
conn.close()
